<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   VerifyCsrfToken.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Http\Middleware;

use Illuminate\Foundation\Http\Middleware\VerifyCsrfToken as Middleware;

class VerifyCsrfToken extends Middleware
{
    
    protected $addHttpCookie = true;

    
    protected $except = [
        
    ];
}
