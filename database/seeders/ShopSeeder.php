<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Shop;
class ShopSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Shop::create([
            'name' => 'Shop One',
            'phone' => '0911223344',
            'address' => 'Yangon',
            'user_id' => 1,
            'tax' => '0.5',
            'created_at' => date('Y-m-d H:m:s'),
            'updated_at' => date('Y-m-d H:m:s'),
        ]);
    }
}
