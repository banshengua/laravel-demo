<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Session;
class CheckLogin
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

    $rel=$request->session()->has('status');
        if(!$rel){
                return redirect('admin/login');
            }

        return $next($request);
    }
}
