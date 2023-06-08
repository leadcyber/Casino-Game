<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   TrimStrings.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\TrimStrings as Middleware;

class TrimStrings extends Middleware
{
    
    protected $except = [
        'password',
        'password_confirmation',
    ];
}
