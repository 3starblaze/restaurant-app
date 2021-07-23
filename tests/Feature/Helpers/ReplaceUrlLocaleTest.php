<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ReplaceUrlLocaleTest extends TestCase
{
    private function assertExtract($url, $locale, $expected)
    {
        return $this->assertSame(replaceUrlLocale($url, $locale), $expected);
    }

    public function test_home()
    {
        $this->assertExtract(
            '/home/lv', 'en',
            '/home/en',
        );
    }

    public function test_restaurant()
    {
        $this->assertExtract(
            '/home/en/restaurant/3', 'lv',
            '/home/lv/restaurant/3'
        );
    }

    public function test_dashboard_url()
    {
        $this->assertExtract(
            '/business/dashboard', 'lv',
            null);
    }

}
