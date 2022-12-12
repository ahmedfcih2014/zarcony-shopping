<?php

namespace Tests\Fakers;

use App\Models\User;

class ClientFaker
{
    use FirstTrait;

    public static function create($count = 10, $attributes = []) {
        return User::factory($count)->create($attributes);
    }

    public static function getClientAuth() : array {
        $email = "client@zarcony.shopping";
        $pass = "12345678";
        $client = ClientFaker::first(['email' => $email, 'password' => $pass]);
        return ['client' => $client, 'username' => $email, 'password' => $pass];
    }
}
