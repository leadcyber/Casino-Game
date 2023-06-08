<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   AccountQuery.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Helpers\Queries;

use App\Helpers\Queries\Filters\UserRoleFilter;
use App\Models\Account;

class AccountQuery extends Query
{
    protected $model = Account::class;

    protected $with = ['user', 'user.profiles', 'user.referrer'];

    protected $filters = ['user' => [UserRoleFilter::class]];

    protected $searchableColumns = [['id'], 'user' => ['users.name', 'users.email']];

    protected $sortableColumns = [
        'id'            => 'id',
        'balance'       => 'balance',
        'updated_ago'   => 'updated_at',
    ];
}
