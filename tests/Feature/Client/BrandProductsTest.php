<?php

namespace Tests\Feature\Client;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Fakers\BrandFaker;
use Tests\TestCase;

class BrandProductsTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase;

    /**
     * here we just build a single happy scenario fetching data for brand products
     * A basic feature test for brand products page.
     * testing route: client.brands.products
     */
    public function test_can_get_brand_products()
    {
        // create brand with 10 products for simulate show product by brand rendering
        $brand = BrandFaker::firstWithProducts()->load('products');

        $response = $this->get(route('client.brands.products', ['brand' => $brand->id]));

        $response->assertStatus(200);

        // iterate through data and check we see it in home page or not
        $response->assertSee($brand->name);
        $brand->products->each(function ($p) use ($response) {
            $response->assertSee($p->small_name);
        });
    }
}
