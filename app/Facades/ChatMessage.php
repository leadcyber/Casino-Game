<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   ChatMessage.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class ChatMessage extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'chat_message';
    }
}
