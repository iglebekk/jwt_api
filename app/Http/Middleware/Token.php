<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class Token
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = $request->bearerToken();

        /** 
         * Må lage en liste med tokens/passord som er godkjente
         */
        if($token != 'FISK')
        {
            return response()->json(['status' => 'Bearer Token invalid'], 401);
        }

        return $next($request);
    }
}
