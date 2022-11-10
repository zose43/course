<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class BrandFactory extends Factory
{
    protected $model = Brand::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->company(),
            'thumbnail' => $this->faker->localImage(
                base_path('tests/Fixtures/images/brands'),
                storage_path('app/public/images/brands')),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'on_main_page' => $this->faker->boolean(),
            'sorting' => $this->faker->numberBetween(1, 999),
        ];
    }
}
