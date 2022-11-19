<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Database\Factories\BrandFactory;
use Database\Factories\CategoryFactory;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        BrandFactory::new()
            ->count(10)->
            create();

        CategoryFactory::new()
            ->count(10)
            ->has(Product::factory(random_int(3, 12)))
            ->create();
    }
}
