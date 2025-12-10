<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;

class HomeController extends Controller
{
    public function index()
    {
        $products = Product::all();
        
        $categories = ProductCategory::all(); 

        return view('welcome', compact('products', 'categories'));
    }
}