<?php

namespace Database\Seeders;

use App\Models\Order;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class OrderTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Order::create([
            'user_id' => 2,
            'product_id' => 2,
            'kuantitas' => 6,
            'total_harga' => 540000,
        ]);
        Order::create([
            'user_id' => 2,
            'product_id' => 5,
            'kuantitas' => 6,
            'total_harga' => 540000,
        ]);
        Order::create([
            'user_id' => 3,
            'product_id' => 1,
            'kuantitas' => 2,
            'total_harga' => 180000,
        ]);
        Order::create([
            'user_id' => 3,
            'product_id' => 8,
            'kuantitas' => 3,
            'total_harga' => 540000,
        ]);
    }
}
