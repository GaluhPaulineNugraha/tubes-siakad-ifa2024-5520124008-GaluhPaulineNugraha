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
        $userRole = $this->getUserRole($user);
        
        foreach ($roles as $role) {
            if ($userRole == $role) {
                return $next($request);
            }
        }
        
        abort(403, 'Unauthorized access. Anda tidak memiliki akses ke halaman ini.');
    }
    
    private function getUserRole($user)
    {
        if ($user->email == 'admin@gmail.com') {
            return 'admin';
        }
        if ($user->nidn != null) {
            return 'dosen';
        }
        if ($user->mahasiswa_id != null) {
            return 'mahasiswa';
        }
        return 'guest';
    }
}