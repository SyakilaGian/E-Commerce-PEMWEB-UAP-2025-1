<?php

namespace App\Http\Controllers\Seller;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use App\Models\Store;

class StoreController extends Controller
{
    /**
     * Form edit profil toko (seller)
     */
    public function edit()
    {
        $store = Auth::user()->store; // ambil store milik user login
        return view('seller.store.edit', compact('store'));
    }

    /**
     * Update profil toko (seller)
     */
    public function update(Request $request)
    {
        $store = Auth::user()->store;

        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'nullable|string',
            'logo' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $data = $request->only(['name', 'description']);

        // Upload logo jika ada
        if ($request->hasFile('logo')) {
            if ($store->logo) {
                Storage::delete($store->logo);
            }
            $data['logo'] = $request->file('logo')->store('logos', 'public');
        }

        $store->update($data);

        return redirect()->route('seller.store.edit')->with('success', 'Profil toko berhasil diperbarui.');
    }

    /**
     * Tampilkan profil toko ke publik (customer bisa lihat)
     */
    public function show(Store $store)
    {
        $products = $store->products()->paginate(12);
        return view('store.show', compact('store', 'products'));
    }
}