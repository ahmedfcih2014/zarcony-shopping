<?php

namespace Tests\Feature\Client;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Fakers\BrandFaker;
use Tests\Fakers\ProductFaker;
use Tests\TestCase;

class ShowProductTest extends TestCase
{
    use RefreshDatabase, DatabaseMigrations;

    /**
     * here we just build a single happy scenario fetching data for home
     * A basic feature test for show product page.
     * testing route: client.products.show
     */
    public function test_can_see_product_successfully()
    {
        $brand = BrandFaker::first();
        $product = ProductFaker::firstByBrand($brand);

        $response = $this->get(route('client.products.show', ['id' => $product->id]));

        $response->assertStatus(200);

        $response->assertSee($product->sku);
        $response->assertSee($product->title);
        $response->assertSee("$product->price");
    }
}
