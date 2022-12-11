<?php

namespace Tests\Fakers;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Database\Eloquent\Collection;

class ProductFaker extends BaseFaker
{
    use FirstTrait;

    public static function create($count = 10, $attributes = []) : Collection {
        return Product::factory($count)->create($attributes);
    }

    public static function createByBrand(Brand $brand, $count = 10, $attributes = []) : Collection {
        $attributes['brand_id'] = $brand->id;
        return self::create($count, $attributes);
    }
}
