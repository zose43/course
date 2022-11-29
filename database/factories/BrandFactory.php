<?php

namespace Database\Factories;

use Support\enums\Paths;
use Illuminate\Support\Carbon;
use Domain\Catalog\Models\Brand;
use Support\Traits\Factories\HasSorting;
use Support\Traits\Factories\HasMainPage;
use Illuminate\Database\Eloquent\Factories\Factory;

class BrandFactory extends Factory
{
    use HasMainPage;
    use HasSorting;

    protected $model = Brand::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->company(),
            'thumbnail' => $this->faker->localImage(
                Paths::FIXTURE_PATH . '/images' . Paths::BrandImages->value,
                Paths::BrandImages->value
            ),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'on_main_page' => $this->faker->boolean(),
            'sorting' => $this->faker->numberBetween(1, 999),
        ];
    }
}
