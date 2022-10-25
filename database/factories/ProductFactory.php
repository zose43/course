<?php

namespace Database\Factories;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class ProductFactory extends Factory
{
    protected $model = Product::class;

    public function definition(): array
    {
        return [
            'thumbnail' => $this->faker->localImage(
                base_path('tests/Fixtures/images/products'),
                storage_path('app/public/images/products')),
            'price' => $this->faker->numberBetween(500, 100000),
            'title' => ucfirst($this->faker->words(2, true)),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'brand_id' => Brand::query()->inRandomOrder()->value('id'),
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
