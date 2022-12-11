<?php

namespace Tests\Feature\Client;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Fakers\BrandFaker;
use Tests\TestCase;

class HomeTest extends TestCase
{
    use RefreshDatabase, DatabaseMigrations;

    /**
     * here we just build a single happy scenario fetching data for home
     * A basic feature test for home page.
     * testing route: client.home
     */
    public function test_can_see_brands_and_products_successfully()
    {
        // create 10 brands and create 1 product for each brand for simulate home page rendering
        $brandsWithProducts = BrandFaker::createWithProducts(
            10, [],
            1, []
        )->load('products');

        $response = $this->get(route('client.home'));

        $response->assertStatus(200);

        // iterate through data and check we see it in home page or not
        $brandsWithProducts->each(function ($b) use ($response) {
            $response->assertSee($b->small_name);
            $response->assertSee($b->products[0]->small_sku);
        });
    }
}
