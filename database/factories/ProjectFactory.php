<?php

namespace Database\Factories;

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
          
        ];
    }
}
