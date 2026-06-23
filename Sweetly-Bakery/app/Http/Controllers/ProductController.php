<?php
namespace App\Http\Controllers;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;

class ProductController extends Controller {
    public function index(Request $request) {
        $query = Product::where('is_available', true)->with('category');
        if ($request->category) $query->where('category_id', $request->category);
        if ($request->search)   $query->where('name','like','%'.$request->search.'%');
        $products   = $query->latest()->get();
        $categories = Category::all();
        return view('products.index', compact('products','categories'));
    }
    public function show(Product $product) {
        return view('products.show', compact('product'));
    }
}
