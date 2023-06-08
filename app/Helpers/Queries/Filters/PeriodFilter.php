<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   PeriodFilter.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Helpers\Queries\Filters;

use Illuminate\Database\Eloquent\Builder;

class PeriodFilter extends Filter
{
    protected $key = 'period';

    public function buildQuery(Builder $query): Builder
    {
        return $query->period($this->getValue());
    }
}
