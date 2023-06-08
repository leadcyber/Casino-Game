<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   LockMultiplayerGame.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Http\Middleware;

use App\Models\MultiplayerGame;
use Closure;
use Illuminate\Support\Facades\DB;

class LockMultiplayerGame
{
    
    public function handle($request, Closure $next)
    {
        
        DB::beginTransaction();

        
        
        $multiplayerGame = $request->route('multiplayerGame');
        if ($multiplayerGame instanceof MultiplayerGame) {
            $multiplayerGame->gameable()->lockForUpdate()->get();
        }

        
        $response = $next($request);

        
        
        DB::commit();

        return $response;
    }
}
