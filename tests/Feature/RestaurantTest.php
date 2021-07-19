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
        URL::defaults(['locale' => 'en']);
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
             ->assertSeeText(__('Edit'));
    }

    public function test_unauthorized_restaurant_does_not_see_edit_button()
    {
        $restaurant = Restaurant::factory()->create();
        $otherUser = User::factory()->create();

        $this->actingAs($otherUser)
             ->get(route('restaurant.show', $restaurant))
             ->assertDontSeeText(__('Edit'));
    }

    public function test_guest_does_not_see_edit_button()
    {
        $restaurant = Restaurant::factory()->create();

        $this->get(route('restaurant.show', $restaurant))
             ->assertStatus(200)
             ->assertDontSeeText(__('Edit'));
    }

    public function test_access_wrong_locale_home()
    {
        $this->get('/home/foo')
             ->assertRedirect('/home/en');

        $this->followingRedirects()
             ->get('/home/foo')
             ->assertSeeText('Language foo does not exist!');
    }

    public function test_access_wrong_locale_restaurant()
    {
        $restaurant = Restaurant::factory()->create();

        $this->get(route('restaurant.show', [
            'restaurant' => $restaurant,
            'locale' => 'foo',
        ]))->assertRedirect(route('restaurant.show', [
            'restaurant' => $restaurant,
            'locale' => 'en',
        ]));

        $this->followingRedirects()
             ->get(route('restaurant.show', [
                 'restaurant' => $restaurant,
                 'locale' => 'foo',
             ]))->assertSeeText('Language foo does not exist!');
    }

    public function test_unapproved_restaurant_is_not_in_index()
    {
        $restaurant = Restaurant::factory(['name' => 'Cafe Incognito'])
                    ->unapproved()
                    ->create();
        $this->get(route('restaurant.index'))
             ->assertDontSeeText('Cafe Incognito');
    }

    public function test_approved_restaurant_is_in_index()
    {
        $restaurant = Restaurant::factory(['name' => 'Beds and food'])
                    ->create();

        $this->get(route('restaurant.index'))
            ->assertSeeText('Beds and food');
    }

    public function test_unapproved_restaurant_cannot_be_reached_by_guest()
    {
        $restaurant = Restaurant::factory()->unapproved()->create();

        $this->get(route('restaurant.show', $restaurant))
            ->assertStatus(403);
    }

    public function test_unapproved_restaurant_cannot_be_reached_by_unauthorized_restaurants()
    {
        $restaurant = Restaurant::factory()->unapproved()->create();
        $unauthorizedUser = User::factory()->create();

        $this->actingAs($unauthorizedUser)
             ->get(route('restaurant.show', $restaurant))
             ->assertStatus(403);
    }

    public function test_unapproved_restaurant_can_be_reached_by_authorized_user()
    {
        $restaurant = Restaurant::factory()->unapproved()->create();

        $this->actingAs($restaurant->user)
             ->get(route('restaurant.show', $restaurant))
             ->assertStatus(200);
    }

    public function test_approved_restaurant_can_be_reached_by_guest()
    {
        $restaurant = Restaurant::factory()->create();

        $this->get(route('restaurant.show', $restaurant))
             ->assertStatus(200);
    }
}
