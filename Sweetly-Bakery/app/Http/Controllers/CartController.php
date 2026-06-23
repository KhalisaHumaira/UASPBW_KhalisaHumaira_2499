<?php
namespace App\Http\Controllers;
use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller {
    public function index() {
        $cart = session('cart', []);
        $total = 0;
        foreach ($cart as $item) $total += $item['price'] * $item['qty'];
        return view('cart.index', compact('cart','total'));
    }

    public function add(Request $request) {
        $request->validate([
            'product_id'  => 'required|exists:products,id',
            'qty'         => 'required|integer|min:1|max:50',
            'custom_note' => 'nullable|max:200',
        ]);
        $product = Product::findOrFail($request->product_id);
        $cart    = session('cart', []);
        $key     = $request->product_id;
        
        $currentQty = isset($cart[$key]) ? $cart[$key]['qty'] : 0;
        $requestedQty = $currentQty + $request->qty;
        
        if ($requestedQty > $product->stock) {
            return redirect()->back()->with('error', 'Stok '.$product->name.' tidak mencukupi. Tersisa: '.$product->stock.' pcs.');
        }

        if (isset($cart[$key])) {
            $cart[$key]['qty'] += $request->qty;
        } else {
            $cart[$key] = [
                'product_id'  => $product->id,
                'name'        => $product->name,
                'image'       => $product->image,
                'emoji'       => $product->emoji,
                'price'       => $product->price,
                'qty'         => $request->qty,
                'custom_note' => $request->custom_note,
            ];
        }
        session(['cart' => $cart]);
        return redirect()->back()->with('success', $product->name.' ditambahkan ke keranjang! 🛒');
    }

    public function update(Request $request, $key) {
        $request->validate(['qty' => 'required|integer|min:1|max:50']);
        $cart = session('cart', []);
        if (isset($cart[$key])) {
            $product = Product::find($cart[$key]['product_id']);
            
            if ($product && $request->qty > $product->stock) {
                $errorMsg = 'Stok '.$product->name.' tidak mencukupi. Tersisa: '.$product->stock.' pcs.';
                if ($request->ajax() || $request->wantsJson()) {
                    return response()->json([
                        'success' => false,
                        'message' => $errorMsg
                    ], 422);
                }
                return back()->with('error', $errorMsg);
            }
            
            $cart[$key]['qty'] = $request->qty;
            session(['cart' => $cart]);
        }
        
        if ($request->ajax() || $request->wantsJson()) {
            $total = 0;
            foreach ($cart as $item) {
                $total += $item['price'] * $item['qty'];
            }
            return response()->json([
                'success' => true,
                'item_total' => 'Rp ' . number_format($cart[$key]['price'] * $cart[$key]['qty'], 0, ',', '.'),
                'total' => 'Rp ' . number_format($total, 0, ',', '.'),
            ]);
        }
        
        return back()->with('success','Keranjang diperbarui.');
    }

    public function remove($key) {
        $cart = session('cart', []);
        unset($cart[$key]);
        session(['cart' => $cart]);
        return back()->with('success','Item dihapus dari keranjang.');
    }

    public function clear() {
        session()->forget('cart');
        return back()->with('success','Keranjang dikosongkan.');
    }
}
