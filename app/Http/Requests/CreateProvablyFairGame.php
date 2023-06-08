<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   CreateProvablyFairGame.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CreateProvablyFairGame extends FormRequest
{
    
    public function authorize()
    {
        return TRUE;
    }

    
    public function rules()
    {
        return [
            'game_package_id'   => 'required', 
            'client_seed'       => 'required|max:32',
        ];
    }
}
