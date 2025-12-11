<?php

namespace App\Http\Controllers;

use App\Http\Requests\ProfileUpdateRequest;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\View\View;
use App\Models\Store;
use App\Models\StoreBalance;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\Facades\Image;

class ProfileController extends Controller
{
    /**
     * Display the user's profile form.
     */
    public function edit(Request $request): View
    {
        return view('profile.edit', [
            'user' => $request->user(),
        ]);
    }

    /**
     * Update the user's profile information.
     */
    public function update(ProfileUpdateRequest $request): RedirectResponse
    {
        $request->user()->fill($request->validated());

        if ($request->user()->isDirty('email')) {
            $request->user()->email_verified_at = null;
        }

        $request->user()->save();

        return Redirect::route('profile.edit')->with('status', 'profile-updated');
    }

    /**
     * Delete the user's account.
     */
    public function destroy(Request $request): RedirectResponse
    {
        $request->validateWithBag('userDeletion', [
            'password' => ['required', 'current_password'],
        ]);

        $user = $request->user();

        Auth::logout();

        $user->delete();

        $request->session()->invalidate();
        $request->session()->regenerateToken();

        return Redirect::to('/');
    }

    /**
     * Menampilkan form registrasi toko.
     * Hanya boleh diakses oleh user yang belum punya toko.
     */
    public function showStoreRegistrationForm(): View|RedirectResponse
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Cek apakah user sudah punya toko
        if ($user->store()->exists()) {
            // Jika sudah punya, arahkan ke dashboard seller
            return Redirect::route('seller.dashboard');
        }

        // View form registrasi toko (buat file: resources/views/seller/register_store.blade.php)
        return view('seller.profile.register');
    }

    /**
     * Proses submit registrasi toko.
     */
    public function submitStoreRegistration(Request $request): RedirectResponse
    {
        /** @var \App\Models\User $user */
        $user = Auth::user();

        // Validasi input
        $request->validate([
            'name'    => 'required|string|max:255|unique:stores,name',
            'about'   => 'nullable|string',
            'address' => 'required|string|max:255',
            'phone'   => 'required|string|max:15',
            'logo'    => 'required|image|mimes:jpg,jpeg,png|max:2048',
        ]);

        try {
            DB::beginTransaction();

            $logoPath = null;
            if ($request->hasFile('logo')) {
                $image = $request->file('logo');
                $filename = time() . '-' . uniqid() . '.png';

                // Resize logo dengan Intervention Image
                $img = Image::make($image)->fit(300, 300);

                $path = 'public/stores/logos/' . $filename;
                Storage::put($path, (string) $img->encode());
                $logoPath = Storage::url($path);
            }

            // Buat record toko
            $store = Store::create([
                'user_id'    => $user->id,
                'name'       => $request->name,
                'about'      => $request->about,
                'phone'      => $request->phone,
                'address'    => $request->address,
                'logo'       => $logoPath,
                'is_verified'=> false, // default pending verifikasi admin
            ]);

        
            // Inisialisasi saldo toko
            StoreBalance::create([
                'store_id'        => $store->id,
                'balance'         => 0,
                'pending_balance' => 0,
            ]);

            DB::commit();

            return Redirect::route('user.home')->with('success', 'Pendaftaran toko berhasil. Menunggu verifikasi admin.');

        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Gagal menyimpan toko. Pastikan semua data benar.');
        }
    }
}