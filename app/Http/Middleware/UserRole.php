<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class UserRole
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if($request->user()->role === 1){ // No es el reclutador, fuera
           return redirect()->route('home');
        };
        return $next($request);// manda llamar el siguiente middleware, que no se cual es, pero esa es su función
    }
}
