<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\URL;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Restaurant;
use App\Models\Reservation;
use DateTime;
use Illuminate\Support\Carbon;
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

    // the same as test_approved_restaurant_can_create
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

    // the same as test_approved_restaurant_can_store
    public function test_authorized_user_can_store() {
        $restaurant = Restaurant::factory()->create();
        $this->actingAs($restaurant->user)
             ->post(route('reservations.store'), $this->defaultPost);
        $this->assertSame(Reservation::all()->count(), 1);
    }

    public function test_unapproved_restaurant_cannot_create()
    {
        $this->actingAs(Restaurant::factory()->unapproved()->create()->user)
             ->get(route('reservations.create'))
             ->assertStatus(403);
    }

    public function test_unapproved_restaurant_cannot_store() {
        $this->actingAs(Restaurant::factory()->unapproved()->create()->user)
             ->post(route('reservations.store'), $this->defaultPost);

        $this->assertSame(Reservation::all()->count(), 0);
    }

    // --------------------------------------------------------

    public function test_authorized_user_can_edit()
    {
        $reservation = Reservation::factory()->create();
        $this->actingAs($reservation->restaurant->user)
             ->get(route('reservations.edit', $reservation))
             ->assertStatus(200);
    }

    public function test_unauthorized_user_cannot_edit()
    {
        $this->actingAs(Restaurant::factory()->create()->user)
             ->get(route('reservations.edit', Reservation::factory()->create()))
             ->assertStatus(403);
    }

    public function test_authorized_restaurant_can_update()
    {
        $reservation = Reservation::factory()->create([
            'start_time' => Carbon::now(),
            'end_time' => Carbon::now(),
            'max_person_count' => 2,
            'description' => 'Old description.',
        ]);

        $this->actingAs($reservation->restaurant->user)
             ->put(route('reservations.update', $reservation), [
                'start_time' => Carbon::today(),
                'end_time' => Carbon::tomorrow(),
                'max_person_count' => 3,
                'description' => 'New description.',
             ])->assertRedirect(route('reservations.show', $reservation));

        $reservation->refresh();
        $this->assertEquals($reservation->start_time, Carbon::today());
        $this->assertEquals($reservation->end_time, Carbon::tomorrow());
        $this->assertSame($reservation->max_person_count, 3);
        $this->assertSame($reservation->description, 'New description.');
    }

    public function test_unauthorized_restaurant_cannot_update()
    {
        $reservation = Reservation::factory()->create([
            'start_time' => Carbon::today(),
            'end_time' => Carbon::tomorrow(),
            'max_person_count' => 2,
            'description' => 'Old description.',
        ]);

        $this->actingAs(Restaurant::factory()->create()->user)
             ->put(route('reservations.update', $reservation), [
                'start_time' => Carbon::now(),
                'end_time' => Carbon::now(),
                'max_person_count' => 3,
                'description' => 'New description.',
             ]);

        $reservation->refresh();
        $this->assertEquals($reservation->start_time, Carbon::today());
        $this->assertEquals($reservation->end_time, Carbon::tomorrow());
        $this->assertSame($reservation->max_person_count, 2);
        $this->assertSame($reservation->description, 'Old description.');
    }
}
