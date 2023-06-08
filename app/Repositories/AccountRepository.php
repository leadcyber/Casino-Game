<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   AccountRepository.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Repositories;

use App\Models\Account;
use App\Models\User;

class AccountRepository
{
    
    public static function create(User $user): Account
    {
        $account = new Account();
        $account->user()->associate($user);
        $account->save();

        return $account;
    }
}
