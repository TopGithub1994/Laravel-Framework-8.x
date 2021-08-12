<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;

class CherckAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next)
    {
        if($request->user == "top"){
            // echo $request;
            return redirect('/');
        }
        else{
            echo $request;
            // return redirect('/about');
        }
        return $next($request);
    }
}
