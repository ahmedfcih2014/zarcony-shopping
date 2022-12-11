<?php

namespace Tests\Feature\Client;

use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\Fakers\ClientFaker;
use Tests\TestCase;

class AuthTest extends TestCase
{
    use RefreshDatabase, DatabaseMigrations;

    /**
     * here we just build a single happy scenario get login page
     * testing route: client.auth.login
     */
    public function test_can_get_login_view()
    {
        $response = $this->get(route('client.auth.login'));

        $response->assertStatus(200);
        $response->assertSee([
            'Login', 'Password', 'Email / Mobile'
        ]);
    }

    /**
     * here we just build a single happy scenario post login
     * testing route: client.auth.login-post
     */
    public function test_can_post_login_form()
    {
        $email = "client@zarcony.shopping";
        $pass = "12345678";
        ClientFaker::first(['email' => $email, 'password' => $pass]);

        $response = $this->post(route('client.auth.login-post'), ['username' => $email, 'password' => $pass]);

        $response->assertRedirect(route('client.home'));
    }

    /**
     * here we just build a single happy scenario for logout
     * testing route: client.auth.logout
     */
    public function test_can_logout() {
        $email = "client@zarcony.shopping";
        $pass = "12345678";
        $client = ClientFaker::first(['email' => $email, 'password' => $pass]);

        $response = $this->actingAs($client)->post(route('client.auth.logout'));
        $response->assertRedirect(route('client.home'));
    }
}
