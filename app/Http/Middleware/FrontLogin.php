<?php

namespace App\Http\Middleware;

use Session;
use Closure;

class FrontLogin
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
        if (empty(Session::has('user')))
        {
            $notification = array(
                'message' => 'Your Session has expired!, please, login to continue...',
                'alert-type' => 'error'
            );

            return redirect()->route('home')->with($notification);
        }
        return $next($request);
    }
}
