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
        // $owner = User::where('type', 'owner')->inRandomOrder()->first();
        return [
         
         'owner_id'=>fake()->unique()->randomNumber(),
           'category_id'=>fake()->unique()->randomNumber(),
            'name'=>fake()->text(),
            'description'=>fake()->text(),
            'owner_id' => User::factory(),
        //   'owner_id' => $owner ? $owner->id : User::factory()->state(['type' => 'owner']),
        //    'owner_id' => User::where('type', 'owner')->fake()->inRandomOrder(),
            'category_id' => Category::factory(),
        ];
    }
}
