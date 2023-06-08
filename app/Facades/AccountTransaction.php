<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   AccountTransaction.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Facades;

use Illuminate\Support\Facades\Facade;

class AccountTransaction extends Facade
{
    protected static function getFacadeAccessor()
    {
        return 'account_transaction';
    }
}
