<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use App\Models\Category;
use App\Models\Product;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        User::create(['name'=>'Admin Sweetly','email'=>'admin@sweetly.com','phone'=>'081234567890','address'=>'Jl. Roti No.1 Jakarta','password'=>Hash::make('admin123'),'role'=>'admin']);
        User::create(['name'=>'Siti Pembeli','email'=>'user@sweetly.com','phone'=>'081234567891','address'=>'Jl. Mawar No.5 Jakarta','password'=>Hash::make('user123'),'role'=>'customer']);

        $cats = [
            ['name'=>'Birthday Cake','icon'=>'🎂','description'=>'Kue ulang tahun custom & siap pakai'],
            ['name'=>'Wedding Cake','icon'=>'💍','description'=>'Kue pernikahan elegan & mewah'],
            ['name'=>'Cupcakes','icon'=>'🧁','description'=>'Cupcake lucu untuk berbagai acara'],
            ['name'=>'Cookies','icon'=>'🍪','description'=>'Aneka cookies renyah dan lezat'],
            ['name'=>'Brownies','icon'=>'🍫','description'=>'Brownies coklat premium'],
            ['name'=>'Tart & Pie','icon'=>'🥧','description'=>'Tart buah dan pie manis'],
        ];
        foreach ($cats as $c) Category::create($c);

        $products = [
            // Birthday Cake
            [1,'Black Forest Birthday','Kue ulang tahun black forest dengan topping cherry segar dan krim lembut',185000,'🎂','#fdf2f8',15,true,true],
            [1,'Strawberry Birthday','Kue ulang tahun strawberry fresh cream, cocok untuk semua usia',175000,'🍓','#fff0f0',12,true,true],
            [1,'Chocolate Ganache','Kue coklat premium dengan ganache glossy dan hiasan bunga edible',220000,'🍫','#3d1f0e',8,true,true],
            [1,'Rainbow Cake','Kue pelangi 7 lapis warna-warni dengan vanilla cream',250000,'🌈','#fef9c3',6,true,true],
            // Wedding Cake
            [2,'Classic Wedding 3 Tier','Kue pernikahan 3 tingkat klasik dengan fondant putih elegan',1500000,'💍','#f8fafc',3,true,true],
            [2,'Rustic Wedding Cake','Kue pernikahan rustic dengan hiasan bunga kering',1200000,'🌸','#fdf4ff',4,true,true],
            // Cupcakes
            [3,'Red Velvet Cupcake','Cupcake red velvet dengan cream cheese frosting (per lusin)',95000,'🧁','#fee2e2',20,true,false],
            [3,'Vanilla Rainbow Cupcake','Cupcake vanilla dengan frosting warna-warni (per lusin)',85000,'🎨','#fdf2f8',25,true,false],
            [3,'Choco Bomb Cupcake','Cupcake coklat dengan isian lava coklat (per lusin)',105000,'💣','#292524',18,true,false],
            // Cookies
            [4,'Butter Cookies Box','Kotak butter cookies premium isi 20 pcs aneka bentuk',65000,'🍪','#fef3c7',30,true,false],
            [4,'Choco Chip Cookies','Cookies oat choco chip crispy (isi 15 pcs)',55000,'🍫','#78350f',35,true,false],
            [4,'Nastar Pineapple','Nastar nanas premium dengan topping keju (isi 20 pcs)',75000,'🍍','#fef9c3',25,true,false],
            // Brownies
            [5,'Fudgy Brownies','Brownies premium super fudgy dengan topping almond',75000,'🍫','#1c0a00',20,true,false],
            [5,'Cream Cheese Brownies','Brownies dengan lapisan cream cheese swirl',85000,'🧀','#fef3c7',15,true,false],
            // Tart & Pie
            [6,'Fruit Tart','Tart krim vanilla dengan topping buah segar (20cm)',145000,'🥝','#f0fdf4',10,true,false],
            [6,'Egg Tart','Egg tart ala Hong Kong (isi 12 pcs)',65000,'🥧','#fef9c3',20,true,false],
        ];
        foreach ($products as $p) {
            Product::create(['category_id'=>$p[0],'name'=>$p[1],'description'=>$p[2],'price'=>$p[3],'emoji'=>$p[4],'bg_color'=>$p[5],'stock'=>$p[6],'is_available'=>$p[7],'is_custom_order'=>$p[8]]);
        }
    }
}
