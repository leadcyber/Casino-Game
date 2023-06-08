<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   CheckSocialProvider.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Http\Middleware;

use Closure;

class CheckSocialProvider
{
    
    public function handle($request, Closure $next)
    {
        if (!config('oauth.'.$request->provider.'.client_id')
            || !config('oauth.'.$request->provider.'.client_secret')) {
            return redirect()->route('login');
        }

        return $next($request);
    }
}
