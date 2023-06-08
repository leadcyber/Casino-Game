<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   CheckPageIsEnabled.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Http\Middleware;

use Closure;

class CheckPageIsEnabled
{
    
    public function handle($request, Closure $next)
    {
        if (!config('settings.content.leaderboard.enabled') && $request->is('api/leaderboard')) {
            return response()->json(['error' => __('Forbidden')], 403);
        }

        return $next($request);
    }
}
