<?php

namespace Database\Factories;

use Domain\Product\Models\Option;
use Domain\Product\Models\OptionValue;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\Factories\Factory;

class OptionValueFactory extends Factory
{
    protected $model = OptionValue::class;

    public function definition(): array
    {
        return [
            'option_id' => Option::query()->inRandomOrder()->value('id'),
            'title' => $this->faker->word(),
            'created_at' => Carbon::now(),
            'updated_at' => Carbon::now(),
        ];
    }
}
