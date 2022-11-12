<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class AjaxController extends Controller
{
    public function product()
    {
        if ($_POST['id']) {
            $product = Product::find($_POST['id']);
        } else {
            $product = Product::all();
        }
        echo json_encode($product);
    }
}
