<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\StoreBalance;
use App\Models\Withdrawal;

class BalanceController extends Controller
{
    /**
     * Tampilkan saldo toko dan riwayat penarikan
     */
    public function index()
    {
        $storeId = Auth::user()->store->id;

        // Ambil saldo toko
        $balance = StoreBalance::where('store_id', $storeId)->value('balance');

        $withdrawals = Withdrawal::whereHas('storeBalance', function ($query) use ($storeId) {
            $query->where('store_id', $storeId);
        })->latest()->get();

        return view('seller.balance.index', compact('balance', 'withdrawals'));
    }

    /**
     * Simpan permintaan penarikan dana
     */
    public function storeWithdrawal(Request $request)
    {
        $storeId = Auth::user()->store->id;

        $request->validate([
            'amount' => 'required|numeric|min:10000', // minimal 10 ribu
        ]);

        // Pastikan saldo cukup
        $currentBalance = StoreBalance::where('store_id', $storeId)->value('balance') ?? 0;
        if ($request->amount > $currentBalance) {
            return redirect()->back()->with('error', 'Saldo tidak mencukupi untuk penarikan.');
        }

        // Buat record penarikan
        Withdrawal::create([
            'store_id' => $storeId,
            'amount' => $request->amount,
            'status' => 'pending', // default pending, admin yang approve
        ]);

        return redirect()->route('seller.balance.index')->with('success', 'Permintaan penarikan berhasil diajukan.');
    }
}
