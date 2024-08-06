<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Project>
 */
class ProjectFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
         
         'owner_id'=>fake()->randomNumber(),
           'category_id'=>fake()->randomNumber(),
            'name'=>fake()->text(),
            'description'=>fake()->text(),
            'owner_id' => User::factory(),
            'category_id' => Category::factory(),
        ];
    }
}
