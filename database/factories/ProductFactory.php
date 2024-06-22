<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Facades\DB;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Product>
 */
class ProductFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->unique()->word(),
            'description' => $this->faker->text(),
            'price' => $this->faker->randomFloat(2, 100, 10000),
            'qty' => $this->faker->numberBetween(0, 1000),
            'sub_category_id' => rand(1, DB::table('sub_categories')->count())
        ];
    }
}
