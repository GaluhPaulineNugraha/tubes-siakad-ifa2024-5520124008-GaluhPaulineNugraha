<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        if (!Auth::check()) {
            return redirect('login');
        }
        
        $user = Auth::user();
        
        // Cek apakah user memiliki salah satu role yang diizinkan
        foreach ($roles as $role) {
            if ($user->hasRole($role)) {
                return $next($request);
            }
        }
        
        // Jika tidak punya akses, lempar error 403
        abort(403, 'Unauthorized access. Anda tidak memiliki akses ke halaman ini.');
    }
}