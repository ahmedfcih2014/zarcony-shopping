<?php

namespace Tests\Fakers;

use App\Models\User;

class ClientFaker
{
    use FirstTrait;

    public static function create($count = 10, $attributes = []) {
        return User::factory($count)->create($attributes);
    }
}
