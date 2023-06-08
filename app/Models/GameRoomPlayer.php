<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   GameRoomPlayer.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GameRoomPlayer extends Model
{
    
    protected $touches = ['room'];

    public function room()
    {
        return $this->belongsTo(GameRoom::class, 'game_room_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function game()
    {
        return $this->belongsTo(Game::class);
    }
}
