<?php

namespace Tests\Fakers;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class BrandFaker
{
    use FirstTrait;

    public static function create($count = 10, $attributes = []) : Collection {
        return Brand::factory($count)->create($attributes);
    }

    public static function createWithProducts(
        $count = 10,
        $attributes = [],
        $productsCount = 10,
        $productsAttributes = []
    ) : Collection {
        return Brand::factory($count)
            ->has(Product::factory($productsCount, $productsAttributes), 'products')
            ->create($attributes);
    }

    public static function firstWithProducts(
        $attributes = [],
        $productsCount = 10,
        $productsAttributes = []
    ) : Collection {
        return self::createWithProducts(1, $attributes, $productsCount, $productsAttributes);
    }
}
