<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Product;

class ProductSeeder extends Seeder
{
    public function run()
    {
        Product::create([
            'nama' => 'Beras Premium 5kg',
            'harga' => 75000,
            'stock' => 100,
            'description' => 'Beras kualitas premium'
        ]);
        
        Product::create([
            'nama' => 'Minyak Goreng 1L',
            'harga' => 25000,
            'stock' => 50,
            'description' => 'Minyak goreng kemasan'
        ]);
        
        Product::create([
            'nama' => 'Gula Pasir 1kg',
            'harga' => 18000,
            'stock' => 75,
            'description' => 'Gula pasir putih'
        ]);
    }
}