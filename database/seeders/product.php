<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class product extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        {
            DB::table('products')->insert([
                'name' => Str::random(10),
                'email' => Str::random(10).'@example.com',
                'password' => Hashy::make('password'),
            ]);
        }
    }
}
