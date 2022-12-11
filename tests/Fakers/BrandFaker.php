<?php

namespace Tests\Fakers;

use App\Models\Brand;
use App\Models\Product;

class BrandFaker
{
    use FirstTrait;

    public static function create($count = 10, $attributes = []) {
        return Brand::factory($count)->create($attributes);
    }

    public static function createWithProducts(
        $count = 10,
        $attributes = [],
        $productsCount = 10,
        $productsAttributes = []
    ) {
        return Brand::factory($count)
            ->has(Product::factory($productsCount, $productsAttributes), 'products')
            ->create($attributes);
    }

    public static function firstWithProducts(
        $attributes = [],
        $productsCount = 10,
        $productsAttributes = []
    ) {
        return self::createWithProducts(1, $attributes, $productsCount, $productsAttributes)->first();
    }
}
