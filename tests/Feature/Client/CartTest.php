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
     *
    client.cart.add-item
    client.cart.remove-item
    client.cart.checkout
     */
}
