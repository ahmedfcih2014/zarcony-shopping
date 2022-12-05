<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // fetch brands for batch insert products
        Brand::orderBy("id", "DESC")->chunk(100, function ($dbBrands) {
            $productCollection = collect([]);
            $dbBrands->each(function ($eachBrand) use (&$productCollection) {
                $products = Product::factory(10)
                    ->make(['brand_id' => $eachBrand->id])
                    ->toArray();
                $productCollection->push(...$products);
            });
            Product::insert($productCollection->toArray());
        });
    }
}
