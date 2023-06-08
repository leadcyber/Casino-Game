<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   GetGame.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetGame extends FormRequest
{
    
    public function authorize()
    {
        return $this->game && $this->game->is_completed;
    }

    
    public function rules()
    {
        return [
            
        ];
    }
}
