<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   AuthServiceProvider.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Providers;

use Illuminate\Foundation\Support\Providers\AuthServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Gate;

class AuthServiceProvider extends ServiceProvider
{
    
    protected $policies = [
        
    ];

    
    public function boot()
    {
        $this->registerPolicies();

        
    }
}
