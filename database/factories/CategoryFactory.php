<?php

namespace Database\Factories;

use App\Models\Category;
use Illuminate\Support\Carbon;
use App\Traits\Factories\HasSorting;
use App\Traits\Factories\HasMainPage;
use Illuminate\Database\Eloquent\Factories\Factory;

class CategoryFactory extends Factory
{
    use HasSorting;
    use HasMainPage;

    protected $model = Category::class;

    public function definition(): array
    {
        return [
            'title' => ucfirst($this->faker->words(2, true)),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
            'on_main_page' => $this->faker->boolean(),
            'sorting' => $this->faker->numberBetween(1, 999),
        ];
    }
}
