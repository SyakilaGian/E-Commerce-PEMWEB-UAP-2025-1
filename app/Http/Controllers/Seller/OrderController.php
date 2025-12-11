<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use App\Models\Transaction;
use Illuminate\Http\Request;

class OrderController extends Controller
{
    /**
     * Tampilkan daftar pesanan seller
     */
    public function index()
    {
        $storeId = Auth::user()->store->id;

        // Ambil semua pesanan milik toko seller
        $orders = Transaction::where('store_id', $storeId)
            ->latest()
            ->paginate(10);

        return view('seller.orders.index', compact('orders'));
    }

    /**
     * Tampilkan detail pesanan
     */
    public function show(Transaction $order)
    {
        // Amankan: pastikan pesanan milik toko seller
        if ($order->store_id !== Auth::user()->store->id) {
            abort(403, 'Akses ditolak. Pesanan ini bukan milik toko Anda.');
        }

        return view('seller.orders.show', compact('order'));
    }

    /**
     * Update status pesanan (misalnya input resi atau ubah status)
     */
    public function update(Request $request, Transaction $order)
    {
        if ($order->store_id !== Auth::user()->store->id) {
            abort(403, 'Akses ditolak.');
        }

        $request->validate([
            'status' => 'required|string|in:pending,processing,shipped,completed,cancelled',
            'resi' => 'nullable|string|max:255',
        ]);

        $order->update([
            'status' => $request->status,
            'resi' => $request->resi,
        ]);

        return redirect()->route('seller.orders.index')->with('success', 'Pesanan berhasil diperbarui.');
    }
}