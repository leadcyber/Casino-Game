<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   CheckRole.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Http\Middleware;

use Closure;

class CheckRole
{
    
    public function handle($request, Closure $next, $role)
    {
        if (!$request->user()->hasRole($role)) {
            return response()->json(['error' => __('Forbidden')], 403);
        }

        return $next($request);
    }
}
