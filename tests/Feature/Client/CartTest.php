<?php

namespace Tests\Feature\Client;

use App\Enum\PaymentEnum;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Fakers\BrandFaker;
use Tests\Fakers\CartFaker;
use Tests\Fakers\ClientFaker;
use Tests\Fakers\PaymentMethodFaker;
use Tests\Fakers\ProductFaker;
use Tests\TestCase;

class CartTest extends TestCase
{
    use DatabaseMigrations, RefreshDatabase;

    /**
     * here we just build a single happy scenario get cart page
     * A basic feature test for cart page.
     * testing route: client.cart.get
     */
    public function test_can_get_cart_page()
    {
        $client = ClientFaker::getClientAuth()['client'];

        $brand = BrandFaker::first();
        $products = ProductFaker::createByBrand($brand, 4);

        $cart = CartFaker::create($client, $products);
        $payment = PaymentMethodFaker::first(['name' => PaymentEnum::cod]);

        $response = $this->actingAs($client)->get(route('client.cart.get'));

        $response->assertStatus(200);
        $response->assertSee($payment->name);

        $cart->items?->each(function ($item) use ($response) {
            $response->assertSee($item->product->name);
        });

        $total = $cart->items->sum(fn ($i) => $i->quantity * $i->product->price);
        $response->assertSee($total);
    }

    /**
     * here we just build a single happy scenario add item to cart page
     * A basic feature test for add to cart form.
     * testing route: client.cart.add-item
     */
    public function test_can_add_to_cart()
    {
        $client = ClientFaker::getClientAuth()['client'];

        $brand = BrandFaker::first();
        $product = ProductFaker::firstByBrand($brand);

        $response = $this->actingAs($client)->post(route('client.cart.add-item', ['product_id' => $product->id]));

        $response->assertRedirect(route('client.cart.get'));

        $response->assertSee($product->name);
    }

    /**
     *
    client.
    client.cart.remove-item
    client.cart.checkout
     */
}
