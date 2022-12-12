<?php

namespace Tests\Fakers;

use App\Models\PaymentMethod;

class PaymentMethodFaker
{
    use FirstTrait;

    public static function create($count = 10, $attributes = []) {
        return PaymentMethod::factory($count)->create($attributes);
    }
}
