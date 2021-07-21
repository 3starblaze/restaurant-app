<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;
use App\Models\User;
use App\Models\Restaurant;

class DashboardTest extends TestCase
{
    use RefreshDatabase;

    public function test_guest_redirect_from_dashboard()
    {
        $this->get('/business/dashboard')->assertRedirect('business/en/login');
    }

    public function test_authorized_can_access_dashboard()
    {
        $restaurant = Restaurant::factory()->create();
        $this->actingAs($restaurant->user)
             ->get('/business/dashboard')
             ->assertStatus(200);
    }

    public function test_user_sees_change_lanaguage_menu()
    {
        $restaurant = Restaurant::factory()->create();
        $this->actingAs($restaurant->user)
             ->get('/business/dashboard')
             ->assertSee(__('Language'));
    }

    public function test_user_can_change_language()
    {
        $user = User::factory()->create(['locale' => 'en']);
        $restaurant = Restaurant::factory()->create(['user_id' => $user->id]);
        $this->actingAs($restaurant->user)
             ->put('/business/dashboard', ['locale' => 'lv']);

        $user->refresh();
        $this->assertSame($user->locale, 'lv');
    }

    public function test_user_language_change_respects_current_url()
    {
        $user = User::factory()->create(['locale' => 'en']);
        $restaurant = Restaurant::factory()->create(['user_id' => $user->id]);
        $this->actingAs($restaurant->user)->get('/home/en');
        $this->put('/business/dashboard', ['locale' => 'lv'])
             ->assertRedirect('/home/lv');

    }

    public function test_user_can_see_restaurant()
    {
        $restaurant = Restaurant::factory()->create();
        $this->actingAs($restaurant->user)
            ->get('/business/dashboard')
            ->assertSeeText(__('Your restaurant'));
    }

    public function test_unapproved_restaurant_cannot_see_unapproved_warning()
    {
        $restaurant = Restaurant::factory()->create();
        $this->actingAs($restaurant->user)
            ->get('/business/dashboard')
            ->assertDontSeeText(__('Your restaurant is not approved'));
    }

    public function test_unapproved_restaurant_can_see_unapproved_warning()
    {
        $restaurant = Restaurant::factory()->unapproved()->create();
        $this->actingAs($restaurant->user)
            ->get('/business/dashboard')
            ->assertSeeText(__('Your restaurant is not approved'));
    }
}
