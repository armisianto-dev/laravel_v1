<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\DeveloperBase;
class VerifyDeveloper
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
    if (!$session) {
      return redirect('/auth/developer');
    }

    return $next($request);
  }
}
