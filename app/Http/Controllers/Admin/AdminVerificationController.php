<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Store;
use Illuminate\Http\Request;

class AdminVerificationController extends Controller
{
    /**
     * Menampilkan daftar toko yang menunggu verifikasi
     */
    public function index()
    {
        // ambil semua store yang belum diverifikasi
        $stores = Store::where('is_verified', false)->paginate(10);

        return view('admin.verification.index', compact('stores'));
    }

    /**
     * Approve toko (set is_verified = true)
     */
    public function approve(Store $store)
{
    // Set toko jadi verified
    $store->update(['is_verified' => true]);

    // Ubah role user pemilik toko jadi seller
    $store->user->update(['role' => 'seller']);

    return redirect()->route('admin.verification.index')
        ->with('success', 'Toko berhasil diverifikasi. User sekarang menjadi seller.');
}

    /**
     * Reject toko (hapus data toko)
     */
    public function reject(Store $store)
    {
        $store->delete();

        return redirect()->route('admin.verification.index')
            ->with('success', 'Toko ditolak dan dihapus.');
    }
}