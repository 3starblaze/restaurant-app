<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\URL;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Restaurant;
use App\Models\Reservation;
use Tests\TestCase;

class ReservationTest extends TestCase
{
    use RefreshDatabase;

    private array $defaultPost = [
        'start-day' => '2021-07-20',
        'start-time' => '17:20',
        'duration' => 30,
        'max-person-count' => 3,
        'description' => 'something',
    ];


    public function setUp(): void
    {
        parent::setUp();
        URL::defaults(['locale' => 'en']);
    }

    public function test_unauthorized_user_cannot_create()
    {
        $this->get(route('reservations.create'))
             ->assertStatus(403);
    }

    public function test_authorized_user_can_create()
    {
        $this->actingAs(Restaurant::factory()->create()->user)
             ->get(route('reservations.create'))
             ->assertStatus(200);
    }

    public function test_guest_cannot_store() {
        $this->post(route('reservations.store'), $this->defaultPost);

        $this->assertSame(Reservation::all()->count(), 0);
    }

    public function test_authorized_user_can_store() {
        $restaurant = Restaurant::factory()->create();
        $this->actingAs($restaurant->user)
             ->post(route('reservations.store'), $this->defaultPost);
        $this->assertSame(Reservation::all()->count(), 1);
    }
}
