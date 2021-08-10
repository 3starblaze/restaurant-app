<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\URL;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use App\Models\Restaurant;
use Tests\TestCase;

class ReservationTest extends TestCase
{
    use RefreshDatabase;

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
}
