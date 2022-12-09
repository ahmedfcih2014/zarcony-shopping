<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Brand;

class BrandController extends Controller
{
    public function index() {
        return view('client.brands.index', [
            'brands' => Brand::latestId()->simplePaginate(50)
        ]);
    }

    public function brandProducts(Brand $brand) {
        return view('client.brands.products', [
            'brand' => $brand,
            'products' => $brand->products()->latestId()->simplePaginate(9)
        ]);
    }
}
