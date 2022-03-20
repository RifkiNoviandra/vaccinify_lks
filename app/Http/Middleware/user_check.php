<?php

namespace App\Http\Middleware;

use App\Models\Society;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class user_check
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
        $token = $request->get("token");

        if (!$token){
            return response([
                'message' => 'Unauthorized User'
            ] , 401);
        }

        $user = Society::where('login_tokens' , $token)->first();

        if (!$user){
            return response([
                'message' => 'user Not Found'
            ] , 401);
        }

        Auth::guard('society')->login($user);

        return $next($request);
    }
}
