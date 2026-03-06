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
    public function handle(Request $request, Closure $next, ...$roles)
    {
        if(!$request->user()){
            return response()->json(['mesasage'=> 'No autenticado'], 400);
        }
        if (in_array($request ->user()-role, $roles)){
            return response()->json([
                'message'=> 'No tienes permiso para esta acción, Rol es requerido'
            ], 400);
        }
        return $next($request);
    }
}
