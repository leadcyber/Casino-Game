<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   BonusQuery.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Helpers\Queries;

use App\Helpers\Queries\Filters\PeriodFilter;
use App\Helpers\Queries\Filters\UserRoleFilter;
use App\Models\Bonus;

class BonusQuery extends Query
{
    protected $model = Bonus::class;

    protected $with = ['account', 'account.user', 'account.user.profiles', 'account.user.referrer'];

    protected $filters = [[PeriodFilter::class], 'account.user' => [UserRoleFilter::class]];

    protected $searchableColumns = [['id'], 'account.user' => ['name', 'email']];

    protected $sortableColumns = [
        'id'            => 'id',
        'amount'        => 'amount',
        'created_ago'   => 'created_at',
    ];
}
