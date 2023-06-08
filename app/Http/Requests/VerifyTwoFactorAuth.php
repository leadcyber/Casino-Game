<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   VerifyTwoFactorAuth.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Http\Requests;

use App\Rules\OneTimePasswordIsCorrect;
use Illuminate\Foundation\Http\FormRequest;

class VerifyTwoFactorAuth extends FormRequest
{
    
    public function authorize()
    {
        return !$this->user()->two_factor_auth_passed;
    }

    
    public function rules()
    {
        return [
            'one_time_password' => [
                'required',
                new OneTimePasswordIsCorrect($this->user()->totp_secret)
            ],
        ];
    }
}
