<?php

namespace App\Http\Controllers\Admin;

use App\Enum\TimeEnum;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Support\Facades\Cache;

class HomeController extends Controller
{
    public function index() {
        $stats = Cache::remember('admin-stats', TimeEnum::tow_hrs, function () {
            return [
                'products' => Product::count(),
                'brands' => Brand::count(),
                'clients' => User::isClient()->count(),
                'orders' => Order::count(),
            ];
        });
        return view("admin.home", ['stats' => $stats]);
    }
}
