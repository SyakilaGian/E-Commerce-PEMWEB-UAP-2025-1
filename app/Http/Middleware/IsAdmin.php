<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

// app/Http/Middleware/IsAdmin.php

// ... (use statements)

class IsAdmin
{
    public function handle(Request $request, Closure $next): Response
    {
        if (!Auth::check()) { // 
            return redirect()->route('login');
        }

        /** @var \App\Models\User $user */ 
        $user = Auth::user();

        $allowedRoles = ['admin', 'superadmin']; 
        
        if (!in_array($user->role, $allowedRoles)) { // <-- Error 'user' di sini (Ln 19)
            abort(403, 'Unauthorized access. Admin Panel only.');
        }

        return $next($request);
    }
}