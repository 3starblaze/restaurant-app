<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\URL;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;
use App\Models\User;
use App\Models\Restaurant;

class RestaurantTest extends TestCase
{
    use RefreshDatabase;

    public function setUp(): void
    {
        parent::setUp();
        URL::defaults(['locale' => \App::getLocale()]);
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

    public function test_authorized_restaurant_can_see_edit_button()
    {
        $restaurant = Restaurant::factory()->create();

        $this->actingAs($restaurant->user)
             ->get(route('restaurant.show', $restaurant))
             ->assertSeeText('(Edit)');
    }

    public function test_unauthorized_restaurant_does_not_see_edit_button()
    {
        $restaurant = Restaurant::factory()->create();
        $otherUser = User::factory()->create();

        $this->actingAs($otherUser)
             ->get(route('restaurant.show', $restaurant))
             ->assertDontSeeText('(Edit)');
    }

    public function test_guest_does_not_see_edit_button()
    {
        $restaurant = Restaurant::factory()->create();

        $this->get(route('restaurant.show', $restaurant))
             ->assertStatus(200)
             ->assertDontSeeText('(Edit)');
    }
}
