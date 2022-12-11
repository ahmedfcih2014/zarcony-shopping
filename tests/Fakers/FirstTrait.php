<?php

namespace Tests\Fakers;

trait FirstTrait
{
    public static function first($attributes = []) {
        return self::create($attributes)->first();
    }
}
