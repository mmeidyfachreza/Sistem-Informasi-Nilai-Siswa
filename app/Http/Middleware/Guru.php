<?php

namespace App\Http\Middleware;

use Closure;

class Guru
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
        if(auth()->check() && auth()->user()->guru != Null){
            return $next($request);
        }

        return redirect('login')->with('error','anda tidak memiliki akses ke halaman tersebut');
    }
}
