<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class IsSeller
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) { // <-- Error 'check' di sini (Ln 15)
            return redirect()->route('login');
        }

        /** @var \App\Models\User $user */ // <-- TAMBAHKAN INI
        $user = Auth::user();

        if ($user->role === 'superadmin') {
            return $next($request);
        }

        if ($user->store()->exists()) {
            return $next($request);
        }
        
        abort(403, 'Unauthorized access. Anda harus mendaftar Toko terlebih dahulu.');
    }
}