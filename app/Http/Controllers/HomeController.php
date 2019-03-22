<?php

namespace App\Http\Controllers;

use App\Deal;
use App\Product;

class HomeController extends Controller
{

    public function index(Product $product,Deal $deal)
    {
        if(auth()->user()->admin){
            return view('admin.dashboard');
        }

        $products = $product->listDashboard();

        $deals = $deal->listDashboard();

        return view('dashboard',compact('products','deals'));

    }
}
