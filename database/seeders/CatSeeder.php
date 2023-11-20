<?php

namespace Database\Seeders;

use App\Models\Cat;
use App\Models\Item;
use Illuminate\Database\Seeder;


class CatSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Cat::factory()
        ->has(Item::factory()->count(3) , 'items')
        ->count(5)
        ->create();
        
        
    }
}
