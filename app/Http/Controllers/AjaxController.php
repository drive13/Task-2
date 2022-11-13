<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Customer;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    /**
     * Ajax to get product data
     */
    public function product()
    {
        if (isset($_GET['id'])) {
            $product = Product::find($_GET['id']);
        } else {
            $product = Product::all();
        }
        echo json_encode($product);
    }

    /**
     * Ajax to get customer data
     */
    public function customer()
    {
        if (isset($_GET['id'])) {
            $customer = Customer::find($_GET['id']);
        } else {
            $customer = Customer::all();
        }
        echo json_encode($customer);
    }
}
