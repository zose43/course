<?php

namespace Database\Factories;

use App\Models\Product;
use Illuminate\Support\Carbon;
use Domain\Catalog\Models\Brand;
use Support\Traits\Factories\HasSorting;
use Support\Traits\Factories\HasMainPage;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    use HasMainPage;
    use HasSorting;

    protected $model = Product::class;

    public function definition(): array
    {
        $path = '/images/products/';

        return [
            'thumbnail' => $this->faker->localImage(
                base_path("tests/Fixtures$path"),
                storage_path("app/public$path"),
                $path),
            'price' => $this->faker->numberBetween(500, 100000),
            'title' => ucfirst($this->faker->words(2, true)),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'brand_id' => Brand::query()->inRandomOrder()->value('id'),
            'on_main_page' => $this->faker->boolean(),
            'sorting' => $this->faker->numberBetween(1, 999),
        ];
    }

    public function cheapen(): self
    {
        return $this->state(function ($attributes) {
            return [
                'price' => $this->faker->numberBetween(100, 2500),
            ];
        });
    }
}
