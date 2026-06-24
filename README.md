1. Sweetly Bakery

Website e-commerce toko kue berbasis Laravel yang memungkinkan pelanggan melakukan pemesanan produk secara online dan admin mengelola seluruh aktivitas toko melalui dashboard khusus.

2. Deskripsi Proyek

Sweetly Bakery merupakan aplikasi web yang dikembangkan menggunakan framework Laravel dengan arsitektur MVC. Sistem ini menyediakan fitur katalog produk, keranjang belanja, pemesanan online, manajemen pesanan, serta dashboard admin untuk mengelola produk dan pengguna.

Proyek ini dibuat sebagai tugas Praktikum Pemrograman Berbasis Web (PBW).

3. Fitur Utama

Customer

* Melihat katalog produk berdasarkan kategori
* Melihat detail produk
* Menambahkan produk ke keranjang
* Checkout dan membuat pesanan
* Melihat riwayat pesanan
* Membatalkan pesanan yang masih berstatus pending

Admin

* Dashboard statistik toko
* Manajemen produk (CRUD)
* Manajemen kategori
* Manajemen pesanan
* Manajemen pengguna

4. Database

Entitas Utama

* Users
* Categories
* Products
* Orders
* Order Items

Relasi

* User memiliki banyak Order
* Order memiliki banyak Order Item
* Category memiliki banyak Product
* Product dapat muncul pada banyak Order Item

5. Akun Demo

Admin

Email: admin@sweetly.com
Password: admin123

Customer

Email: user@sweetly.com
Password: user123
