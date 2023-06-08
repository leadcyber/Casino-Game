<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   RedirectIfAuthenticated.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfAuthenticated
{
    
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            return response()->json(['error' => 'Already authenticated.'], 400);
        }

        return $next($request);
    }
}
