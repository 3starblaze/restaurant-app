<?php

namespace Database\Factories;

use App\Models\Restaurant;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Support\Str;

class RestaurantFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Restaurant::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'user_id' => function() { return User::factory()->create(); },
            'name' => $this->faker->word(),
            'description' => $this->faker->paragraph(),
            'latitude' => $this->faker->randomFloat(4, 56.9513 - 0.01, 56.9513 + 0.01),
            'longitude' => $this->faker->randomFloat(4, 24.1325 - 0.1, 24.1325 + 0.1),
            'approved_at' => now(),
        ];
    }

    /**
     * Indicate that the model's email address should be unverified.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unverified()
    {
        return $this->state(function (array $attributes) {
            return [
                'email_verified_at' => null,
            ];
        });
    }

    /**
     * Indicate that the model should be unapproved.
     *
     * @return \Illuminate\Database\Eloquent\Factories\Factory
     */
    public function unapproved()
    {
        return $this->state(function (array $attributes) {
            return [
                'approved_at' => null,
            ];
        });
    }
}
