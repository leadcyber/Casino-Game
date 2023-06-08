<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   ResetPasswordController.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\ResetsPasswords;

class ResetPasswordController extends Controller
{
    

    use ResetsPasswords;

    
    protected function rules()
    {
        return [
            'token'     => 'required',
            'email'     => 'required|email',
            'password'  => 'required|confirmed|min:6',
            'password_confirmation' => 'required',
        ];
    }
}
