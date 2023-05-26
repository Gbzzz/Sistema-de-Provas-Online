<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DiscenteAccess
{
    public function handle(Request $request, Closure $next)
    {
        // verificando se ele está autenticado e se no db ele está com permissão de amin
        if(Auth::check() && Auth::user()->discente == 1){
            return $next($request);
        }else{
            // mandando pra rota de login, caso n esteja autenticado
            if(!Auth::check()){
                return redirect('/login');
            }

            return redirect('/dashboard');
        }
    }
}
