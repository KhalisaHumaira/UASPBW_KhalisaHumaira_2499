<?php
use Illuminate\Support\Facades\Route;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminOrderController;

Route::get('/', function () {
    if (! Auth::check()) {
        return redirect()->route('login');
    }

    return Auth::user()->isAdmin()
        ? redirect()->route('admin.dashboard')
        : redirect()->route('products.index');
});

Route::middleware('guest')->group(function () {
    Route::get('/login',     [AuthController::class,'showLogin'])->name('login');
    Route::post('/login',    [AuthController::class,'login']);
    Route::get('/register',  [AuthController::class,'showRegister'])->name('register');
    Route::post('/register', [AuthController::class,'register']);
});
Route::post('/logout', [AuthController::class,'logout'])->name('logout')->middleware('auth');

// Customer
Route::middleware('auth')->group(function () {
    Route::get('/products',              [ProductController::class,'index'])->name('products.index');
    Route::get('/products/{product}',    [ProductController::class,'show'])->name('products.show');
    Route::get('/cart',                  [CartController::class,'index'])->name('cart.index');
    Route::post('/cart/add',             [CartController::class,'add'])->name('cart.add');
    Route::patch('/cart/{key}',          [CartController::class,'update'])->name('cart.update');
    Route::delete('/cart/{key}',         [CartController::class,'remove'])->name('cart.remove');
    Route::delete('/cart',               [CartController::class,'clear'])->name('cart.clear');
    Route::get('/checkout',              [OrderController::class,'checkout'])->name('orders.checkout');
    Route::post('/orders',               [OrderController::class,'store'])->name('orders.store');
    Route::get('/orders',                [OrderController::class,'index'])->name('orders.index');
    Route::get('/orders/{order}',        [OrderController::class,'show'])->name('orders.show');
    Route::patch('/orders/{order}/cancel',[OrderController::class,'cancel'])->name('orders.cancel');
});

// Admin
Route::middleware(['auth','is_admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard',                    [AdminController::class,'dashboard'])->name('dashboard');
    Route::post('/categories',                  [AdminController::class,'storeCategory'])->name('categories.store');
    Route::get('/products',                     [AdminProductController::class,'index'])->name('products.index');
    Route::get('/products/create',              [AdminProductController::class,'create'])->name('products.create');
    Route::post('/products',                    [AdminProductController::class,'store'])->name('products.store');
    Route::get('/products/{product}/edit',      [AdminProductController::class,'edit'])->name('products.edit');
    Route::put('/products/{product}',           [AdminProductController::class,'update'])->name('products.update');
    Route::delete('/products/{product}',        [AdminProductController::class,'destroy'])->name('products.destroy');
    Route::get('/orders',                       [AdminOrderController::class,'index'])->name('orders.index');
    Route::get('/orders/{order}',               [AdminOrderController::class,'show'])->name('orders.show');
    Route::patch('/orders/{order}/status',      [AdminOrderController::class,'updateStatus'])->name('orders.status');
    Route::get('/users',                        [AdminController::class,'users'])->name('users');
    Route::delete('/users/{user}',              [AdminController::class,'deleteUser'])->name('users.delete');
});
