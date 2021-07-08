<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;

class DashboardTest extends TestCase
{

    public function test_guest_redirect_from_dashboard()
    {
        $this->get('/business/dashboard')->assertRedirect('business/en/login');
    }
}
