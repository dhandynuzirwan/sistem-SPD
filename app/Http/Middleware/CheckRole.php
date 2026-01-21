<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Symfony\Component\HttpFoundation\Response;

class CheckRole
{
    /**
     * Handle an incoming request.
     */
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // dd(Auth::user()->employee->role, $roles);
        // 1. Cek apakah user sudah login
        if (!Auth::check()) {
            return redirect()->route('login');
        }

        // 2. Ambil data user yang sedang login
        $user = Auth::user();

        // 3. Cek apakah user punya data employee dan apakah rolenya sesuai
        // Kita menggunakan in_array karena role di route bisa lebih dari satu (misal: role:finance,director)
        if ($user->employee && in_array($user->employee->role, $roles)) {
            return $next($request);
        }

        // 4. Jika tidak punya akses, arahkan ke dashboard yang sesuai rolenya
        return redirect()->route('login')->with('error', 'Maaf, Anda tidak memiliki akses ke halaman tersebut.');
    }
}