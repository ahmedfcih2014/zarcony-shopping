<?php

namespace Database\Seeders;

use App\Models\Brand;
use App\Models\Product;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // batch insert brands
        $brands = Brand::factory(1000)->make();
        // for remove appends
        Brand::insert($brands->map(function ($b) {return ['name' => $b->name];})->toArray());
    }
}
