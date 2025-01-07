<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\Player;
use App\Models\User;
use Illuminate\Database\Seeder;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        User::factory()->create([
            'name' => 'Admin',
            'email' => 'admin@example.com',
        ]);
        $categories = array(
            [
                'name' => 'Junior',
                'value' => 15,
            ],
            [
                'name' => 'Mid',
                'value' => 20,
            ],
            [
                'name' => 'Senior',
                'value' => 23,
            ]
        );

        foreach ($categories as $category){
            Category::factory()
                ->has(Player::factory()->count(3))
                ->create($category);
        }
    }
}
