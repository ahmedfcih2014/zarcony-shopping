<?php

namespace App\Http\Controllers\Client;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Http\Request;

class ProductController extends Controller
{
    public function index() {
        return view('client.home.index', [
            'products' => Product::latestId()->simplePaginate(),
            'brands' => Brand::latestId()->limit(10)->get()
        ]);
    }

    public function show($id) {
        return view('client.products.show', [
            'product' => Product::findOrFail($id)
        ]);
    }
}
