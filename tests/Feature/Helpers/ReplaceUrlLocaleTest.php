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

    public function test_change_1()
    {
        $this->assertExtract(
            'https://www.something.com/home/lv/nothing', 'en',
            'https://www.something.com/home/en/nothing',
        );
    }

    public function test_change_2()
    {
        $this->assertExtract(
            'https://www.something.com/home/en/somebody', 'lv',
            'https://www.something.com/home/lv/somebody'
        );
    }

    public function test_dashboard_url()
    {
        $this->assertExtract(
            'https://www.something.com/business/dashboard', 'lv',
            null);
    }

}
