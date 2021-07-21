<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExtractUrlLocaleTest extends TestCase
{
    private function assertExtract($parameter, $expected)
    {
        return $this->assertSame(extractUrlLocale($parameter), $expected);
    }

    public function test_1()
    {
        $this->assertExtract('/home/lv/nothing', 'lv');
    }

    public function test_2()
    {
        $this->assertExtract('/home/en/absolutely/nothing', 'en');
    }

    public function test_no_trailing_slash()
    {
        $this->assertExtract('/home/lv', 'lv');
    }

    public function test_business_route()
    {
        $this->assertExtract('/business/lv/register', 'lv');
    }

    public function test_business_route_no_trailing_slash()
    {
        $this->assertExtract('/business/en', 'en');
    }
}
