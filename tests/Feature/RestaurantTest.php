<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Restaurant;

class RestaurantTest extends TestCase
{
    use RefreshDatabase;
    /**
     * A basic feature test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }

    public function test_authorized_restaurant_can_edit()
    {
        $restaurant = Restaurant::factory()->create();
        $this->actingAs($restaurant->user)
             ->get(route('restaurant.edit', $restaurant))
             ->assertStatus(200);
    }

    public function test_unauthorized_restaurant_cannot_edit()
    {
        $restaurant = Restaurant::factory()->create();
        $otherUser = User::factory()->create();

        $this->actingAs($otherUser)
             ->get(route('restaurant.edit', $restaurant))
             ->assertStatus(403);
    }

    public function test_authorized_restaurant_can_update()
    {
        $restaurant = Restaurant::factory()->create([
            'name' => 'Old name',
            'description' => 'Old description.',
        ]);

        $this->actingAs($restaurant->user)
             ->put(route('restaurant.update', $restaurant), [
                 'name' => 'New name',
                 'description' => 'New description.',
             ])->assertRedirect(route('restaurant.show', $restaurant));

        $restaurant->refresh();
        $this->assertSame($restaurant->name, 'New name');
        $this->assertSame($restaurant->description, 'New description.');
    }

    public function test_unauthorized_restaurant_cannot_update()
    {
        $restaurant = Restaurant::factory()->create([
            'name' => 'Old name',
            'description' => 'Old description.',
        ]);
        $otherUser = User::factory()->create();

        $this->actingAs($otherUser)
             ->put(route('restaurant.update', $restaurant), [
                 'name' => 'New name',
                 'description' => 'New description',
             ]);

        $restaurant->refresh();
        $this->assertSame($restaurant->name, 'Old name');
        $this->assertSame($restaurant->description, 'Old description.');
    }
}
