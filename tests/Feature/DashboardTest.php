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
             ->put('/business/dashboard', ['locale' => 'lv'])
             ->assertRedirect('/business/dashboard');

        $user->refresh();
        $this->assertSame($user->locale, 'lv');
    }
}
