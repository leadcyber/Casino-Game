<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   UpdatePassword.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Http\Requests;

use App\Rules\PasswordIsCorrect;
use Illuminate\Foundation\Http\FormRequest;

class UpdatePassword extends FormRequest
{
    
    public function authorize()
    {
        return true;
    }

    
    public function rules()
    {
        

        return [
            'current_password' => [
                'required',
                new PasswordIsCorrect($this->user())
            ],
            'password'              => 'required|confirmed|min:6',
            'password_confirmation' => 'required'
        ];
    }
}
