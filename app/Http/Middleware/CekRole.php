<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CekRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // 1. Cek apakah user login?
        if (!Auth::check()) {
            return redirect('login');
        }

        // 2. Ambil role user yang sedang login
        $user = Auth::user();

        // 3. Cek apakah role user termasuk dalam role yang diizinkan (admin atau pegawai)
        // Fungsi in_array akan mencocokkan role user dengan daftar $roles yang dikirim dari route
        if (in_array($user->role, $roles)) {
            return $next($request);
        }

        // 4. Jika role tidak cocok, redirect atau tampilkan error 403
        return abort(403, 'Anda tidak memiliki akses ke halaman ini.');
    }
}