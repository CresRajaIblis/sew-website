<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next, $role)
{
    // Jika user belum login, lempar ke login
    if (!auth()->check()) {
        return redirect('/login');
    }

    // Jika role user tidak sesuai dengan yang diminta halaman
    if (auth()->user()->role !== $role) {
        abort(403, 'Anda tidak punya akses ke halaman ini');
    }

    return $next($request);
}
}
