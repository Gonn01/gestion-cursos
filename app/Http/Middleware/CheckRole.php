<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CheckRole
{
    public function handle(Request $request, Closure $next, ...$roles)
    {
        $user = $request->user();

        // Si no hay usuario logueado o el rol no está permitido
        if (!$user || !in_array($user->rol, $roles)) {
            abort(403, 'No tienes permisos para acceder.');
        }

        return $next($request);
    }
}
