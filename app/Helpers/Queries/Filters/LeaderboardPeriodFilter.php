<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   LeaderboardPeriodFilter.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Helpers\Queries\Filters;

use Illuminate\Database\Eloquent\Builder;

class LeaderboardPeriodFilter extends PeriodFilter
{
    public function buildQuery(Builder $query): Builder
    {
        return $query->period($this->getValue(), 'games');
    }
}
