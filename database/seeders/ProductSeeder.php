<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Shop;
use App\Models\Product;
use App\Models\User;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        $user = User::create([
            'name' => 'Demo Shop',
            'email' => 'shop@bikehub.com',
            'password' => bcrypt('password'),
            'role' => 'shop_owner',
        ]);

        $shop = Shop::create([
            'user_id' => $user->id,
            'name' => 'Pedro\'s Bike Shop',
            'slug' => 'pedros-bike-shop',
            'address' => '123 Rizal St',
            'city' => 'Manila',
        ]);

        $bikes = [
            ['name'=>'Trek Marlin 5','brand'=>'Trek','category'=>'mountain','price'=>18500,'stock'=>5],
            ['name'=>'Giant Escape 3','brand'=>'Giant','category'=>'road','price'=>14999,'stock'=>3],
            ['name'=>'Polygon Xtrada 5','brand'=>'Polygon','category'=>'mountain','price'=>22000,'stock'=>4],
            ['name'=>'Trinx M136','brand'=>'Trinx','category'=>'mountain','price'=>8500,'stock'=>8],
            ['name'=>'Cube Acid 200','brand'=>'Cube','category'=>'kids','price'=>6999,'stock'=>6],
            ['name'=>'Xiaomi Electric Bike','brand'=>'Xiaomi','category'=>'electric','price'=>45000,'stock'=>2],
        ];

        foreach ($bikes as $bike) {
            Product::create([
                'shop_id' => $shop->id,
                'name' => $bike['name'],
                'slug' => \Str::slug($bike['name']),
                'brand' => $bike['brand'],
                'category' => $bike['category'],
                'price' => $bike['price'],
                'stock' => $bike['stock'],
                'is_available' => true,
            ]);
        }
    }
}