<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   UserStatusFilter.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Helpers\Queries\Filters;

use App\Models\User;

class UserStatusFilter extends EnumFilter
{
    protected $key = 'status';
    protected $model = User::class;
    protected $table = 'users';
}
