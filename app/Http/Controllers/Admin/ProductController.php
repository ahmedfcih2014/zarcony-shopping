<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Product\CreateRequest;
use App\Http\Requests\Admin\Product\UpdateRequest;
use App\Models\Brand;
use App\Models\Product;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    private const productAttributes = [
        "title", "sku", "details", "price", "brand_id"
    ];
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $products = Product::filter()->latestId()->simplePaginate();
        return view("admin.products.index", ['products' => $products]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.products.create", ['brands' => Brand::all()]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param CreateRequest $request
     */
    public function store(CreateRequest $request)
    {
        $requestData = $request->only(self::productAttributes);
        $requestData['sku'] = Str::slug($requestData['sku']);
        Product::create($requestData);

        return redirect(route("admin.products.index"))
            ->with("success-message", __("messages.product-created"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     */
    public function edit(Product $product)
    {
        return view("admin.products.edit", ['product' => $product, 'brands' => Brand::all()]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Product $product
     */
    public function update(UpdateRequest $request, Product $product)
    {
        $requestData = $request->only(self::productAttributes);
        $requestData['sku'] = Str::slug($requestData['sku']);
        $product->update($requestData);

        return redirect(route("admin.products.index"))
            ->with("success-message", __("messages.product-updated"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     */
    public function destroy(Product $product)
    {
        $product->delete();
        return redirect(route("admin.products.index"))
            ->with("success-message", __("messages.product-deleted"));
    }
}
