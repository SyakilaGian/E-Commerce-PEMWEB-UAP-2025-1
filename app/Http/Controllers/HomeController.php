<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Transaction;

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

        session([
            'last_checkout_data' => [
                'product_slug' => $slug,
                'quantity' => $qty
            ]
        ]);

        $product = \App\Models\Product::where('slug', $slug)->firstOrFail();
        $subtotal = $product->price * $qty;

        return view('pages.checkout', compact('product', 'qty', 'subtotal'));
    }

    public function processCheckout(Request $request)
    {
        $transaction = \App\Models\Transaction::create([
            'buyer_id' => auth()->id(),
            'store_id' => \App\Models\Product::find($request->product_id)->store_id,
            'code' => 'TRX-' . mt_rand(10000, 99999),
            'payment_method' => $request->payment_method,
            'grand_total' => $request->total_price,
            'shipping' => $request->shipping_method,
            'address' => $request->address . ', ' . $request->city . ', ' . $request->postal_code,
            'city' => $request->city,
            'postal_code' => $request->postal_code,
            'payment_status' => 'unpaid'
        ]);

        \App\Models\TransactionDetail::create([
            'transaction_id' => $transaction->id,
            'product_id' => $request->product_id,
            'quantity' => $request->quantity,
            'price' => \App\Models\Product::find($request->product_id)->price,
        ]);

        if ($request->payment_method == 'wallet') {
            $user = auth()->user();
            
            $currentBalance = $user->balance ? $user->balance->balance : 0;
            
            if ($currentBalance < $request->total_price) {
                return redirect()->back()->with('error', 'Saldo Wallet tidak cukup atau belum aktif! Silakan Topup dulu.');
            }

            if ($user->balance) {
                $user->balance->decrement('balance', $request->total_price);
            }

            $transaction->update(['payment_status' => 'paid']);

            return redirect()->route('home')->with('success', 'Pembayaran Berhasil via Wallet!');
        }

        else {
            $vaNumber = '88000' . rand(1000, 9999) . rand(100, 999);
            
            return redirect()->route('front.payment', [
                'va_number' => $vaNumber,
                'amount' => $request->total_price,
                'type' => 'transaction',
                'trx_id' => $transaction->id
            ]);
        }
    }

    public function topup()
    {
        session()->forget('last_checkout_data');
        
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

            if (session()->has('last_checkout_data')) {
                $checkoutData = session('last_checkout_data');
                
                // Redirect KEMBALI ke halaman Checkout (bawa data produk tadi)
                return redirect()->route('checkout', $checkoutData)
                    ->with('success', 'Topup Berhasil! Saldo bertambah. Silakan lanjutkan pembayaran.');
            }
            return redirect()->route('home')->with('success', 'Topup Berhasil! Saldo sudah masuk.');
        }

        else if ($type == 'transaction') {
            $trxId = $request->input('trx_id');
            
            $transaction = \App\Models\Transaction::find($trxId);
            if ($transaction) {
                $transaction->update(['payment_status' => 'paid']);
                
                foreach($transaction->details as $detail) {
                    $detail->product->decrement('stock', $detail->quantity);
                }
            }

            return redirect()->route('home')->with('success', 'Pembayaran Belanjaan Berhasil! Barang akan segera dikirim.');
        }

        return redirect()->route('home');
    }

    public function orders()
    {
        $transactions = Transaction::where('buyer_id', auth()->id())
            ->with(['details.product'])
            ->latest()
            ->get();

        return view('pages.orders', compact('transactions'));
    }

    public function store($slug)
    {
        // 1. Cari Toko berdasarkan Slug (misal: karisya-official)
        $store = \App\Models\Store::where('slug', $slug)->firstOrFail();

        // 2. Ambil semua produk milik toko tersebut
        $products = \App\Models\Product::where('store_id', $store->id)->latest()->get();

        // 3. Tampilkan view
        return view('pages.store', compact('store', 'products'));
    }
}