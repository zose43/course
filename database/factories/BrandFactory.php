<?php

namespace Database\Factories;

use App\Models\Brand;
use Illuminate\Support\Carbon;
use App\Traits\Factories\HasSorting;
use App\Traits\Factories\HasMainPage;
use Illuminate\Database\Eloquent\Factories\Factory;

class BrandFactory extends Factory
{
    use HasMainPage;
    use HasSorting;

    protected $model = Brand::class;

    public function definition(): array
    {
        $path = '/images/brands/';

        return [
            'title' => $this->faker->company(),
            'thumbnail' => $this->faker->localImage(
                base_path("tests/Fixtures$path"),
                storage_path("app/public$path"),
                $path),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'on_main_page' => $this->faker->boolean(),
            'sorting' => $this->faker->numberBetween(1, 999),
        ];
    }
}
