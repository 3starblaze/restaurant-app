<?php

namespace Database\Factories;

use App\Models\Reservation;
use App\Models\Restaurant;
use Illuminate\Database\Eloquent\Factories\Factory;

class ReservationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Reservation::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'restaurant_id' => Restaurant::factory()->create(),
            'starttime' => now(),
            'endtime' => $this->faker->time(),
            'personcount' => rand(1, 5),
            'tablenum' => rand(1, 20),
            'reserver' => $this->faker->name(),
            'description' => $this->faker->paragraph(),
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
}
