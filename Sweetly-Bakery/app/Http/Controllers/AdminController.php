<?php
namespace App\Http\Controllers;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;

class AdminController extends Controller {
    public function dashboard() {
        return view('admin.dashboard', [
            'totalOrders'    => Order::count(),
            'totalRevenue'   => Order::whereIn('status',['confirmed','process','ready','delivered'])->sum('total_price'),
            'totalProducts'  => Product::count(),
            'totalCustomers' => User::where('role','customer')->count(),
            'recentOrders'   => Order::with(['user','items.product'])->latest()->take(6)->get(),
            'pendingOrders'  => Order::where('status','pending')->count(),
        ]);
    }
    public function users() {
        return view('admin.users.index', ['users'=>User::latest()->get()]);
    }
    public function deleteUser(User $user) {
        if ($user->id === auth()->id()) return back()->with('error','Tidak bisa hapus akun sendiri.');
        $user->delete();
        return back()->with('success','User dihapus.');
    }
    public function storeCategory() {
        $icon = request('icon');
        $name = request('name');
        
        if (!$icon || !$name) {
            return response()->json(['success' => false, 'message' => 'Ikon dan nama harus diisi']);
        }
        
        $category = Category::create(['icon' => $icon, 'name' => $name]);
        return response()->json(['success' => true, 'id' => $category->id]);
    }
}
