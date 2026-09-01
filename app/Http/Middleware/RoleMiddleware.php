<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class RoleMiddleware
{
    public function handle(Request $request, Closure $next, ...$roles): Response
    {
        // Cek jika user belum login
        if (!$request->user()) {
            return redirect()->route('login')->withErrors([
                'auth' => 'Silahkan login terlebih dahulu.'
            ]);
        }

        // Ambil role_id user langsung dari database (tipe data cast ke string agar aman diproses)
        $userRoleId = (string) $request->user()->role_id;

        // Cek apakah role_id user ada dalam daftar yang diperbolehkan
        if (!in_array($userRoleId, $roles)) {
            abort(403, 'Unauthorized');
        }

        return $next($request);
    }
}