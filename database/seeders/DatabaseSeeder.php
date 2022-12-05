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
            ->count(20)->
            create();

        CategoryFactory::new()
            ->count(20)
            ->has(Product::factory(random_int(5, 15)))
            ->create();
    }
}
