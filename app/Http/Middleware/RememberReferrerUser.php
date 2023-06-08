<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   RememberReferrerUser.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Http\Middleware;

use Closure;

class RememberReferrerUser
{
    
    public function handle($request, Closure $next)
    {
        $response = $next($request);

        
        if ($request->is('/') && !$request->hasCookie('ref') && $request->query('ref') ) {
            
            $response->cookie('ref', $request->query('ref'), 525600);
        }

        return $response;
    }
}
