<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
class Checkuser
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

    $rel=$request->session()->has('msg');
        if(!$rel){
                return redirect('login');
            }

        return $next($request);
    }
}
