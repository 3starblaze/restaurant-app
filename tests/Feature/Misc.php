<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Support\Facades\URL;
use Tests\TestCase;
use App\Models\User;
use App\Models\Restaurant;

class DashboardTest extends TestCase
{
    public function test_legal_renders() {
        $this->get(route('legal'))->assertStatus(200);
    }
}
