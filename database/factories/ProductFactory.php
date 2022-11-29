<?php

namespace Database\Factories;

use App\Models\Product;
use Support\enums\Paths;
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
        return [
            'thumbnail' => $this->faker->localImage(
                Paths::FIXTURE_PATH . '/images' . Paths::ProductImages->value,
                Paths::ProductImages->value
            ),
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
