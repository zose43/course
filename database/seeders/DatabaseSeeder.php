<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;
use Database\Factories\BrandFactory;
use Database\Factories\OptionFactory;
use Database\Factories\CategoryFactory;
use Database\Factories\PropertyFactory;
use Database\Factories\OptionValueFactory;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $properties = PropertyFactory::new()
            ->count(10)
            ->create();

        BrandFactory::new()
            ->count(20)->
            create();

        OptionFactory::new()
            ->count(2)
            ->create();

        $optionValues = OptionValueFactory::new()
            ->count(10)
            ->create();

        CategoryFactory::new()
            ->count(20)
            ->has(
                Product::factory(random_int(5, 15))
                    ->hasAttached($properties, fn() => ['value' => fake()->word()])
                    ->hasAttached($optionValues)
            )->create();
    }
}
