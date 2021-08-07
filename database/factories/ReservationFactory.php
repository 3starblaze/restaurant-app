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
        $baseDate = $this->faker->dateTimeBetween('now', '+2 week');
        $delta = new \DateInterval($this->faker->randomElement([
            'PT60M',
            'PT90M',
            'PT120M',
        ]));

        return [
            'start_time' => $baseDate,
            'end_time' => (clone $baseDate)->add($delta),
            'max_person_count' => $this->faker->numberBetween(1, 4),
            'description' => $this->faker->paragraph(),
            'restaurant_id' => function () { return Restaurant::factory()->create(); },
        ];
    }
}
