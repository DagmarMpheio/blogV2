<?php

namespace App\Http\Middleware;

use Closure;

class AdminCheck
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request $request
     * @param  \Closure $next
     * @return mixed
     */

    /*verificar se o usuario eh admin*/
    public function handle($request, Closure $next)
    {
        if ($request->user()->type == 'admin') {
            return $next($request);
        }

        return abort(403, "Accesso negado");
    }
}
