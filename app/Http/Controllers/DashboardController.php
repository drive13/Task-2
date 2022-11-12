<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use App\Models\Product;
use App\Models\SalesOrder;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function index()
    {
        return view('dashboard', [
            'products' => Product::count(),
            'customers' => Customer::count(),
            'sales' => SalesOrder::count(),
        ]);
    }
}
