<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   DisableTwoFactorAuth.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Http\Requests;

use App\Rules\OneTimePasswordIsCorrect;
use App\Rules\PasswordIsCorrect;
use Illuminate\Foundation\Http\FormRequest;

class DisableTwoFactorAuth extends FormRequest
{
    
    public function authorize()
    {
        
        return $this->user()->two_factor_auth_enabled;
    }

    
    public function rules()
    {
        $user = $this->user()->loadMissing('profiles');

        return [
            'one_time_password' => [
                'required',
                new OneTimePasswordIsCorrect($user->totp_secret)
            ],
            
            'password' => $user->profiles->isEmpty()
                ? ['required', new PasswordIsCorrect($user)]
                : ''
        ];
    }
}
