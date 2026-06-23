# Sweetly Bakery

## Akun Demo
- Admin: admin@sweetly.com / admin123
- Customer: user@sweetly.com / user123

## Setup
1. composer create-project laravel/laravel Sweetly
2. Copy semua file dari ZIP
3. bootstrap/app.php tambahkan:
   $middleware->alias(['is_admin' => \App\Http\Middleware\IsAdmin::class]);
4. .env: DB_DATABASE=sweetly
5. Buat database sweetly di phpMyAdmin
6. php artisan migrate:fresh --seed
7. php artisan serve
