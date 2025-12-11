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
    public function filterCategory($slug)
    {
        $category = ProductCategory::where('slug', $slug)->firstOrFail();
        $products = $category->products()->latest()->get();
        $categories = ProductCategory::all();

        return view('welcome', compact('products', 'categories'));
    }

    public function details($slug)
    {
        $product = Product::with(['store', 'productCategory'])
                    ->where('slug', $slug)
                    ->firstOrFail();

        $recommendations = Product::where('id', '!=', $product->id)->inRandomOrder()->take(4)->get();

        return view('pages.product-detail', compact('product', 'recommendations'));
    }

    public function checkout(Request $request)
    {
        $slug = $request->input('product_slug');
        $qty = $request->input('quantity', 1);

        if (!$slug) {
            return redirect()->route('home');
        }

        $product = Product::where('slug', $slug)->firstOrFail();
        
        $subtotal = $product->price * $qty;

        return view('pages.checkout', compact('product', 'qty', 'subtotal'));
    }
}