<?php
namespace App\Http\Controllers;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AdminOrderController extends Controller {
    public function index() {
        $orders = Order::with(['user','items.product'])->latest()->paginate(15);
        return view('admin.orders.index', compact('orders'));
    }
    public function show(Order $order) {
        return view('admin.orders.show', compact('order'));
    }
    public function updateStatus(Request $request, Order $order) {
        $request->validate(['status'=>'required|in:pending,confirmed,process,ready,delivered,cancelled']);

        $previousStatus = $order->status;
        $newStatus = $request->status;

        DB::transaction(function () use ($order, $request, $previousStatus, $newStatus) {
            $order->update(['status' => $newStatus]);

            if ($request->payment_status) {
                $order->update(['payment_status' => $request->payment_status]);
            }

            // Kurangi stok saat pesanan terkirim (delivered)
            if ($newStatus === 'delivered' && $previousStatus !== 'delivered') {
                foreach ($order->items as $item) {
                    $item->product->decrement('stock', $item->qty);
                }
            }

            // Kembalikan stok jika pesanan dibatalkan dari status delivered
            if ($newStatus === 'cancelled' && $previousStatus === 'delivered') {
                foreach ($order->items as $item) {
                    $item->product->increment('stock', $item->qty);
                }
            }
        });

        return back()->with('success','Status pesanan diperbarui!');
    }
}
