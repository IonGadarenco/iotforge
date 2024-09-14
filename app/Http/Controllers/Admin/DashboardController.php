<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\Group;
use App\Models\Order;
use App\Models\Product;
use App\Models\RouteAccessCount;
use App\Models\SubCategory;
use App\Models\Unit;
use Illuminate\Support\Arr;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class DashboardController extends Controller
{
    public function index()
    {
        $totalAccessCount = RouteAccessCount::sum('access_count');
        return view('admin.dashboard', compact('totalAccessCount'));
    }

}
