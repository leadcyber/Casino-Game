<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   LogoutIfBlocked.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Http\Middleware;

use App\Models\User;
use Closure;

class LogoutIfBlocked
{
    
    public function handle($request, Closure $next)
    {
        
        if (!$request->user()->is_active) {
            auth()->guard('web')->logout();
            abort(401);
        }

        return $next($request);
    }
}
