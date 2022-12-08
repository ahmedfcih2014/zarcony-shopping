<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Admin\Brand\CreateRequest;
use App\Http\Requests\Admin\Brand\UpdateRequest;
use App\Models\Brand;
use Illuminate\Http\Request;

class BrandController extends Controller
{
    private const brandAttributes = ["name"];

    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $brands = Brand::filter()->latestId()->simplePaginate();
        return view("admin.brands.index", ['brands' => $brands]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view("admin.brands.create");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  CreateRequest  $request
     */
    public function store(CreateRequest $request)
    {
        Brand::create($request->only(self::brandAttributes));
        return redirect(route("admin.brands.index"))
            ->with("success-message", __("messages.brand-created"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param Brand $brand
     */
    public function edit(Brand $brand)
    {
        return view("admin.brands.edit", ['brand' => $brand]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateRequest $request
     * @param Brand $brand
     */
    public function update(UpdateRequest $request, Brand $brand)
    {
        $brand->update($request->only(self::brandAttributes));

        return redirect()->back()->with("success-message", __("messages.brand-updated"));
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Brand $brand
     */
    public function destroy(Brand $brand)
    {
        if ($brand->products->first()) {
            return redirect()->back()
                ->with("warn-message", __("messages.brand-has-products", ['name' => $brand->name]));
        }
        $brand->delete();
        return redirect()->back()->with("success-message", __("messages.brand-deleted"));
    }
}
