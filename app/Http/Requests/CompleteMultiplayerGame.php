<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   CompleteMultiplayerGame.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Http\Requests;

use App\Models\MultiplayerGame;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

class CompleteMultiplayerGame extends FormRequest
{
    protected $gameableClass;

    
    public function authorize()
    {
        return $this->multiplayerGame instanceof MultiplayerGame
            && $this->multiplayerGame->gameable_type == $this->gameableClass
            && $this->multiplayerGame->end_time->lt(Carbon::now());
    }

    
    public function rules()
    {
        return [];
    }
}
