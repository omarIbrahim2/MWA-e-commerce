<?php

namespace Database\Seeders;

use App\Models\Cat;
use App\Models\Item;
use App\Models\Product;
use Illuminate\Database\Seeder;


class CatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cat::factory()
        ->has(Item::factory()
        ->has(Product::factory()
        ->count(20), 'products' )
        ->count(15) , 'items')
        ->count(2)
        ->create();
        
        
    }
}
