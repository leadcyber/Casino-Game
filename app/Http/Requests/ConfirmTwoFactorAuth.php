<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   ConfirmTwoFactorAuth.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Http\Requests;

use App\Rules\OneTimePasswordIsCorrect;
use Illuminate\Foundation\Http\FormRequest;

class ConfirmTwoFactorAuth extends FormRequest
{
    
    public function authorize()
    {
        
        return !$this->user()->two_factor_auth_enabled;
    }

    
    public function rules()
    {
        return [
            'secret' => 'required|string|size:32',
            'one_time_password' => [
                'required',
                new OneTimePasswordIsCorrect($this->secret),
            ]
        ];
    }
}
