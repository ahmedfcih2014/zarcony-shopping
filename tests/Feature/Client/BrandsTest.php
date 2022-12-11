<?php

namespace Tests\Feature\Client;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Fakers\BrandFaker;
use Tests\TestCase;

class BrandsTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase;

    /**
     * here we just build a single happy scenario fetching data for brands
     * A basic feature test for brands page.
     * testing route: client.brands.list
     */
    public function test_can_see_brands()
    {
        // create 10 brands for simulate brands page rendering
        $brands = BrandFaker::create();

        $response = $this->get(route('client.brands.list'));

        $response->assertStatus(200);

        // iterate through data and check we see it in home page or not
        $brands->each(function ($b) use ($response) {
            $response->assertSee($b->small_name);
        });
    }
}
