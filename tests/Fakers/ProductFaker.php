<?php

namespace Tests\Fakers;

use App\Models\Brand;
use App\Models\Product;

class ProductFaker
{
    use FirstTrait;

    public static function create($count = 10, $attributes = []) {
        return Product::factory($count)->create($attributes);
    }

    public static function createByBrand(Brand $brand, $count = 10, $attributes = []) {
        $attributes['brand_id'] = $brand->id;
        return self::create($count, $attributes);
    }

    public static function firstByBrand(Brand $brand, $attributes = []) {
        return self::createByBrand($brand, 1, $attributes)->first();
    }
}
