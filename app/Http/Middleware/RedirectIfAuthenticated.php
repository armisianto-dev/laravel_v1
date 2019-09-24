<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        $session = $request->session()->get('login_developer');
        if (!empty($session)) {
            return redirect('/'.$session['default_page']);
        }else{
            return redirect('/auth/developer');
        }

        return $next($request);
    }
}
