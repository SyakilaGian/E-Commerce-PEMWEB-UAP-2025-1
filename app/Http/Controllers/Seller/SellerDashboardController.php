<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Transaction;
use App\Models\ProductReview;
use Illuminate\Support\Facades\Auth;

class SellerDashboardController extends Controller
{
    public function index()
    {
        $storeId = Auth::user()->store->id ?? null;

        return view('seller.dashboard', [
            'activeProducts' => Product::where('store_id', $storeId)->count(),
            'salesToday' => Transaction::where('store_id', $storeId)
                ->whereDate('created_at', today())
                ->sum('grand_total'),
            'pendingOrders' => Transaction::where('store_id', $storeId)
                ->where('status', 'pending')
                ->count(),
            'latestReviews' => ProductReview::where('store_id', $storeId)->count(),
        ]);
    }
}