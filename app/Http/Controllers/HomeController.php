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

    public function topup()
    {
        return view('pages.topup');
    }

    public function postTopup(Request $request)
    {
        $request->validate([
            'amount' => 'required|numeric|min:10000',
        ]);

        $vaNumber = '88000' . rand(1000, 9999) . rand(100, 999);

        return redirect()->route('front.payment', [
            'va_number' => $vaNumber,
            'amount' => $request->amount,
            'type' => 'topup' 
        ]);
    }

    public function payment(Request $request)
    {
        $vaNumber = $request->query('va_number');
        $amount = $request->query('amount');
        $type = $request->query('type');

        if (!$vaNumber || !$amount) {
            return redirect()->route('home')->with('error', 'Data pembayaran tidak valid');
        }

        return view('pages.payment', compact('vaNumber', 'amount', 'type'));
    }

    public function paymentPost(Request $request)
    {
        $type = $request->input('type');
        $amount = $request->input('amount');

        if ($type == 'topup') {
            $user = auth()->user();
            
            $balance = $user->balance ?? $user->balance()->create(['balance' => 0]);
            
            $balance->balance += $amount;
            $balance->save();

            return redirect()->route('home')->with('success', 'Topup Berhasil! Saldo sudah masuk.');
        }
        return redirect()->route('home');
    }
}