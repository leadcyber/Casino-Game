<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   UpdateLastSeen.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class UpdateLastSeen
{
    
    public function handle(Request $request, Closure $next)
    {
        $user = $request->user();

        
        
        if ($user && (is_null($user->last_seen_at) || $user->last_seen_at->lte(Carbon::now()->subSeconds(5)))) {
            tap($request->user(), function ($user) { $user->is_online = TRUE; })->save();
        }

        return $next($request);
    }
}
