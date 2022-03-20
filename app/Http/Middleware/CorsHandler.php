<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CorsHandler
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure(\Illuminate\Http\Request): (\Illuminate\Http\Response|\Illuminate\Http\RedirectResponse)  $next
     * @return \Illuminate\Http\Response|\Illuminate\Http\RedirectResponse
     */
    public function handle(Request $request, Closure $next)
    {
        return 1;
        return $next($request)
            ->header('Access-Control-Allow-Origin', '*')
            ->header('Access-Control-Allow-Methods', '*')
            ->header('Access-Control-Allow-Credentials', true)
            ->header('Access-Control-Allow-Headers', 'X-Requested-With,Content-Type,X-Token-Auth,Authorization')
            ->header('Accept', 'application/json');

        header("Access-Control-Allow-Origin: *");

        $header = [
            'Access-Control-Allow-Methods' => 'POST , GET , DELETE , PUT',
            'Access-Control-Allow-Headers' => 'Content-Type , X-Auth-Token, Origin'
        ];

        $response = $next($request);

        foreach ($header as $key => $value) {
            $response->header($key , $value);
        }

        return $response;
    }
}
