<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class FrontController extends Controller
{
    public function index()
    {
        $products = Product::with('productCategory')->latest()->get();
        $categories = ProductCategory::all();

        return view('welcome', compact('products', 'categories'));
    }

    public function filterCategory($slug)
    {
        $category = ProductCategory::where('slug', $slug)->firstOrFail();

        $products = $category->products()->latest()->get();
        $categories = ProductCategory::all();

        return view('welcome', compact('products', 'categories'));
    }
}