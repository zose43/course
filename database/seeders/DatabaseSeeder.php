<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Brand::factory(10)->create();
        Category::factory(10)
            ->has(Product::factory(random_int(3, 12)))
            ->create();
    }
}
