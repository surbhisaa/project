<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class IsLogin
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
        if(auth()->check()){
            if(auth()->user()->profile_type){
                return redirect()->route('AdminLogin')->with('message','Welcome to the admin dashboard');
            
            }else{
            return redirect()->route('Profile')->with('message','welcome to the user profile');
            }
        
        }
        return $next($request);
        dd($request);
    }
}
