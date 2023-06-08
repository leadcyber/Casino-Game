<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   UpdateMultiplayerGame.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Request;

class UpdateMultiplayerGame extends FormRequest
{
    protected $player;
    protected $game;

    
    public function authorize()
    {
        $this->player = $this->room->player($this->user());
        $this->game = $this->player ? $this->player->game : NULL;

        return $this->room->is_open 
            && $this->room->activePlayers->count() == $this->room->parameters->players_count 
            && $this->player 
            && $this->game 
            && $this->game->is_in_progress; 
    }

    
    public function rules(Request $request)
    {
        return [];
    }
}
