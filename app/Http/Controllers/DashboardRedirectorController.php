<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\RedirectResponse;

class DashboardRedirectorController extends Controller
{
    public function index(): RedirectResponse
    {
        $user = Auth::user();

        // PENTING: Pastikan kolom 'role' ada di tabel users
        if ($user->role === 'admin') {
            return redirect()->route('admin.dashboard');
        } 
        
        if ($user->role === 'seller') {
            return redirect()->route('seller.dashboard');
        }
        
        // Default (Role: user atau lainnya)
        return redirect()->route('user.home');
    }
}