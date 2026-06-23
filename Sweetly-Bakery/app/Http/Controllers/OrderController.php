<?php
namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class OrderController extends Controller {
    public function index() {
        $orders = Order::where('user_id', Auth::id())->with('items.product')->latest()->get();
        return view('orders.index', compact('orders'));
    }

    public function checkout() {
        $cart = session('cart', []);
        if (empty($cart)) return redirect()->route('cart.index')->with('error','Keranjang kosong!');
        $total = 0;
        foreach ($cart as $item) $total += $item['price'] * $item['qty'];
        return view('orders.checkout', compact('cart','total'));
    }

    public function store(Request $request) {
        $request->validate([
            'delivery_address' => 'required|min:5',
            'delivery_date'    => 'required|date|after:today',
            'delivery_time'    => 'required',
            'payment_method'   => 'required|in:transfer,cod,ewallet',
            'note'             => 'nullable|max:500',
        ],[
            'delivery_address.required' => 'Alamat pengiriman wajib diisi.',
            'delivery_address.min'      => 'Alamat minimal 5 karakter.',
            'delivery_date.required'    => 'Tanggal pengiriman wajib diisi.',
            'delivery_date.after'       => 'Tanggal pengiriman harus setelah hari ini.',
            'delivery_time.required'    => 'Jam pengiriman wajib diisi.',
            'payment_method.required'   => 'Metode pembayaran wajib dipilih.',
        ]);

        $cart = session('cart', []);
        if (empty($cart)) return redirect()->route('cart.index')->with('error','Keranjang kosong!');

        // Cek kecukupan stok sebelum memproses checkout
        foreach ($cart as $item) {
            $product = Product::find($item['product_id']);
            if (!$product || $item['qty'] > $product->stock) {
                return redirect()->route('cart.index')->with('error', 'Stok '.$item['name'].' tidak mencukupi atau telah berubah. Tersisa: '.($product ? $product->stock : 0).' pcs.');
            }
        }

        DB::transaction(function () use ($request, $cart) {
            $total = 0;
            foreach ($cart as $item) $total += $item['price'] * $item['qty'];

            $order = Order::create([
                'user_id'          => Auth::id(),
                'order_code'       => 'SWL-'.strtoupper(Str::random(8)),
                'delivery_address' => $request->delivery_address,
                'delivery_date'    => $request->delivery_date,
                'delivery_time'    => $request->delivery_time,
                'note'             => $request->note,
                'total_price'      => $total,
                'status'           => 'pending',
                'payment_method'   => $request->payment_method,
                'payment_status'   => 'unpaid',
            ]);

            foreach ($cart as $item) {
                OrderItem::create([
                    'order_id'    => $order->id,
                    'product_id'  => $item['product_id'],
                    'qty'         => $item['qty'],
                    'price'       => $item['price'],
                    'subtotal'    => $item['price'] * $item['qty'],
                    'custom_note' => $item['custom_note'] ?? null,
                ]);
            }
        });

        session()->forget('cart');
        return redirect()->route('orders.index')->with('success','Pesanan berhasil dibuat! 🎂 Kami akan segera mengkonfirmasi pesananmu.');
    }

    public function show(Order $order) {
        if ($order->user_id !== Auth::id()) abort(403);
        return view('orders.show', compact('order'));
    }

    public function cancel(Order $order) {
        if ($order->user_id !== Auth::id()) abort(403);
        if (!in_array($order->status, ['pending','confirmed'])) return back()->with('error','Pesanan tidak bisa dibatalkan.');
        $order->update(['status'=>'cancelled']);
        return back()->with('success','Pesanan dibatalkan.');
    }
}
