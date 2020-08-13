<?php

namespace App\Http\Middleware;

use Closure;
class Verifiedphone
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
        if(isset(auth()->user()->id)){
            if(auth()->user()->status==0){
                return redirect()->route('verify.show',['phone'=>auth()->user()->phone,'token'=>auth()->user()->token_verify]);
            }
        }else{
            return redirect('/login');
        }
        return $next($request);
    }
}
