<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        $products = [
            [
                'name' => 'Nasi Goreng Spesial',
                'description' => 'Nasi goreng dengan telur, ayam, dan sayuran',
                'price' => 25000,
                'image' => 'image/Nasi_Goreng.jpeg',
            ],
            [
                'name' => 'Sate Ayam',
                'description' => 'Sate ayam dengan bumbu kacang',
                'price' => 30000,
                'image' => 'image/Satee.jpg',
            ],
            // Tambahkan produk lainnya di sini
        ];
    
        foreach ($products as $product) {
            Product::create($product);
        }
    }
}
