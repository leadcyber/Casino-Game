<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   BroadcastServiceProvider.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class BroadcastServiceProvider extends ServiceProvider
{
    
    public function boot()
    {
        require base_path('routes/channels.php');
    }
}
