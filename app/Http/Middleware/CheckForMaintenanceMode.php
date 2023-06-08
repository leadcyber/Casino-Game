<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   CheckForMaintenanceMode.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Http\Middleware;

use Closure;
use Illuminate\Foundation\Http\Middleware\CheckForMaintenanceMode as Middleware;
use Illuminate\Foundation\Http\Exceptions\MaintenanceModeException;

class CheckForMaintenanceMode extends Middleware
{
    
    protected $except = [
        
    ];

    
    public function handle($request, Closure $next)
    {
        $user = $request->user();
        if ((!$user || !$user->is_admin) && $this->app->isDownForMaintenance()) {
            $data = json_decode(file_get_contents($this->app->storagePath() . '/framework/down'), true);

            throw new MaintenanceModeException(time(), $data['retry']);
        }

        return $next($request);
    }
}
