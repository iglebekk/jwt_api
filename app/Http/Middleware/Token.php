<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use App\Models\Jwt;
use Carbon\Carbon;


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
        if(count(explode('.', $request->bearerToken())) < 3) {
            return response()->json(['status' => 'token missing or wrong format'], 400);
        }

        $secret     = env('APP_KEY');
        $token      = $request->bearerToken();
        $result     = (new Jwt)->decodeToken($token, $secret);
        $now        = Carbon::now();
        
        /**
        * Checks if the token is correct and not tampered with.
        */
        if(!$result)
        {
            return response()->json(['status' => 'invalid bearer token'], 401);
        }
        
        /**
        * If not premium check request counting.
        */
        if(!$result->premium)
        {
            /**
            * Checks if last request is the same as this month. If not it resets the counter.
            */
            if($result->mnt_req != $now->month)
            {
                $result->ant_req = 0;
            }
            
            /**
            * Checks if maxium numbers of requests has been reached.
            */
            if($result->ant_req >= env('MAX_REQ'))
            {
                return response()->json(['status' => 'number of requests exceeded limit this month'], 401);
            }
            
            /**
            * Adds one to counted requests
            */
            $result->ant_req = $result->ant_req + 1;
        }

        /**
         * Converts the strClass to array and puts the result in $request to be used later
         */

        $request->attributes->add(json_decode(json_encode($result), true));
                
        return $next($request);
    }
}
