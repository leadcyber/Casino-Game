<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   LockGameRoom.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Http\Middleware;

use App\Models\GameRoom;
use Closure;
use Illuminate\Support\Facades\DB;

class LockGameRoom
{
    
    public function handle($request, Closure $next)
    {
        
        DB::beginTransaction();

        
        $roomId = (int) $request->room_id ?: ($request->room && $request->room instanceof GameRoom ? $request->room->id : 0);

        
        
        if ($roomId){
            GameRoom::where('id', $roomId)->lockForUpdate()->first();
        }

        
        $response = $next($request);

        
        
        DB::commit();

        return $response;
    }
}
