<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   TwoFactorAuthentication.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Route;

class TwoFactorAuthentication
{
    
    public function handle($request, Closure $next)
    {
        $user = $request->user();
        $route = Route::currentRouteName();

        
        if ($user->two_factor_auth_enabled
            && !$user->two_factor_auth_passed
            && !in_array($route, ['user', 'user.security.2fa.verify'])) {
            return $request->expectsJson()
                ? abort(HTTP_CODE_2FA_NOT_PASSED)
                : Redirect::to('/2fa');
        }

        return $next($request);
    }
}
