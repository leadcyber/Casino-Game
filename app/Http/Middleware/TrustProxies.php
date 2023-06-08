<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   TrustProxies.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Http\Middleware;

use Illuminate\Http\Request;
use Fideloper\Proxy\TrustProxies as Middleware;

class TrustProxies extends Middleware
{
    
    protected $proxies;

    
    protected $headers = Request::HEADER_X_FORWARDED_ALL;
}
