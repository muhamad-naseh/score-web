<?php

namespace Database\Factories;

use App\Models\Category;
use App\Models\Player;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Carbon;

class PlayerFactory extends Factory
{
    protected $model = Player::class;

    public function definition(): array
    {
        return [
            'name' => $this->faker->name(),
            'birth' => Carbon::now(),
            'gender' => $this->faker->randomElement(['male', 'female']),
            'team' => $this->faker->randomElement(['A', 'B']),
            'address' => $this->faker->address(),
            'age' => $this->faker->randomNumber(2),
            'weight' => $this->faker->randomNumber(2),
        ];
    }
}
