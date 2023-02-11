<?php

namespace Database\Factories;

use Support\enums\Paths;
use Illuminate\Support\Carbon;
use Domain\Catalog\Models\Brand;
use Domain\Product\Models\Product;
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
        return [
            'thumbnail' => $this->faker->localImage(Paths::ProductImages->value),
            'price' => $this->faker->numberBetween(convertPrice(500), convertPrice(90000)),
            'title' => ucfirst($this->faker->words(2, true)),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'brand_id' => Brand::query()->inRandomOrder()->value('id'),
            'on_main_page' => $this->faker->boolean(),
            'sorting' => $this->faker->numberBetween(1, 999),
            'text' => $this->faker->realText(),
            'quantity' => $this->faker->numberBetween(0, 20),
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
