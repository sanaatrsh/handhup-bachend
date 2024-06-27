<?php

namespace Database\Seeders;

use App\Models\Project;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class productseedertable extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {       Project::factory(10)->create();
         Project::factory()->create([
            'name' => 'Test User',
            'email' => 'test@example.com',
        ]);
    }
}
