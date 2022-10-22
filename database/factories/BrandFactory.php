<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends Factory<Brand>
 */
class BrandFactory extends Factory
{
    protected $model = Brand::class;

    public function definition(): array
    {
        return [
            'title' => $this->faker->company(),
            // TODO 3rd lesson
            'thumbnail' => '',
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
