<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   ArtisanService.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/


namespace App\Services;

use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Cache;

class ArtisanService
{
    public static function migrateAndSeed()
    {
        
        Artisan::call('migrate', [
            '--force' => TRUE,
        ]);

        
        Artisan::call('db:seed', [
            '--force' => TRUE,
        ]);
    }

    public static function clearAllCaches()
    {
        
        Cache::flush();
        
        Artisan::call('config:clear');
        
        Artisan::call('cache:clear');
        
        Artisan::call('view:clear');
        
        Artisan::call('route:clear');
    }
}
