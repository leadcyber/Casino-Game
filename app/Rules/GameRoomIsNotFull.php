<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   GameRoomIsNotFull.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Rules;

use App\Models\GameRoom;
use Illuminate\Contracts\Validation\Rule;

class GameRoomIsNotFull implements Rule
{
    private $room;

    
    public function __construct(GameRoom $room)
    {
        $this->room = $room;
    }

    
    public function passes($attribute, $value)
    {
        return $this->room->players->count() < (int) $this->room->parameters->players_count;
    }

    
    public function message()
    {
        return __('The game room is already full.');
    }
}
