<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class EnsureUserRole
{

    public function handle(Request $request, Closure $next, $role): Response
    {
        $user = $request->user();

        // Jika rute ini khusus admin, tapi yang login id_role-nya BUKAN 1 (Admin)
        if ($role === 'admin' && $user->id_role != 1) {
            return redirect()->route('user.dashboard');
        }

        // Jika rute ini khusus user, tapi yang login id_role-nya BUKAN 2 (Penyewa)
        if ($role === 'user' && $user->id_role != 2) {
            return redirect()->route('admin.dashboard');
        }

        return $next($request);
    }
}
