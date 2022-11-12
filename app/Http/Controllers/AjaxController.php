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
        if ($_POST['id']) {
            $product = Product::find($_POST['id']);
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
        if ($_POST['id']) {
            $customer = Customer::find($_POST['id']);
        } else {
            $customer = Customer::all();
        }
        echo json_encode($customer);
    }
}
