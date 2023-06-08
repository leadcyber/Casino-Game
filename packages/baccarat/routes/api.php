<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   api.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

use Packages\Baccarat\Http\Controllers\GameController;


Route::name('games.baccarat.')
    ->middleware(['api', 'auth:sanctum', 'verified', 'active', '2fa', 'concurrent', 'last_seen'])
    ->group(function () {
        
        Route::post('api/games/baccarat/play', [GameController::class, 'play'])->name('play');
    });
