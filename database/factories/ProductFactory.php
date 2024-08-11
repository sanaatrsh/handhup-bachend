<?php

namespace Database\Factories;

use App\Models\Project;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

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
          'project_id'=>fake()->unique()->randomNumber(),
            'name' => fake()->name(),
            'price'=>fake()->randomFloat(),
             // 'slug'=>fake()->slug(),
            'available'=>fake()->boolean(),
            'description'=>fake()->text(),
             'project_id' => Project::factory(),
        ];
    }
}
