<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Domain\Catalog\Models\Brand;
use Domain\Catalog\Models\Product;
use Domain\Catalog\Models\Category;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        Brand::factory(10)->create();
        Category::factory(10)
            ->has(Product::factory(random_int(3, 12))->cheapen())
            ->create();
    }
}
