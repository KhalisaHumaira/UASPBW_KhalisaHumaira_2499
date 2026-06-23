<?php
namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class AdminProductController extends Controller {
    public function index() {
        return view('admin.products.index', ['products'=>Product::with('category')->latest()->get()]);
    }
    public function create() {
        return view('admin.products.create', ['categories'=>Category::all()]);
    }
    public function store(Request $request) {
        $request->validate([
            'name'        => 'required|min:2',
            'category_id' => 'required|exists:categories,id',
            'description' => 'nullable|max:500',
            'price'       => 'required|integer|min:1000',
            'stock'       => 'required|integer|min:0',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
            'bg_color'    => 'nullable',
        ],[
            'name.required'        => 'Nama produk wajib diisi.',
            'category_id.required' => 'Kategori wajib dipilih.',
            'price.required'       => 'Harga wajib diisi.',
            'price.min'            => 'Harga minimal Rp 1.000.',
            'stock.required'       => 'Stok wajib diisi.',
        ]);
        $imagePath = $request->hasFile('image') ? $request->file('image')->store('products', 'public') : null;

        Product::create([
            'name'            => $request->name,
            'category_id'     => $request->category_id,
            'description'     => $request->description,
            'price'           => $request->price,
            'stock'           => $request->stock,
            'image'           => $imagePath,
            'emoji'           => '🎂',
            'bg_color'        => $request->bg_color ?? '#fdf2f8',
            'is_available'    => $request->has('is_available'),
            'is_custom_order' => $request->has('is_custom_order'),
        ]);
        return redirect()->route('admin.products.index')->with('success','Produk berhasil ditambahkan!');
    }
    public function edit(Product $product) {
        return view('admin.products.edit', compact('product'), ['categories'=>Category::all()]);
    }
    public function update(Request $request, Product $product) {
        $request->validate([
            'name'        => 'required|min:2',
            'category_id' => 'required|exists:categories,id',
            'price'       => 'required|integer|min:1000',
            'stock'       => 'required|integer|min:0',
            'image'       => 'nullable|image|mimes:jpg,jpeg,png,webp|max:4096',
        ]);

        if ($request->hasFile('image')) {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }
            $imagePath = $request->file('image')->store('products', 'public');
        }

        $product->update([
            'name'            => $request->name,
            'category_id'     => $request->category_id,
            'description'     => $request->description,
            'price'           => $request->price,
            'stock'           => $request->stock,
            'image'           => $request->hasFile('image') ? $imagePath : $product->image,
            'emoji'           => $product->emoji,
            'bg_color'        => $request->bg_color ?? $product->bg_color,
            'is_available'    => $request->has('is_available'),
            'is_custom_order' => $request->has('is_custom_order'),
        ]);
        return redirect()->route('admin.products.index')->with('success','Produk diperbarui!');
    }
    public function destroy(Product $product) {
        $product->delete();
        return back()->with('success','Produk dihapus.');
    }
}
