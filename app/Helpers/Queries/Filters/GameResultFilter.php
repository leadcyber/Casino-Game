<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   GameResultFilter.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Helpers\Queries\Filters;

use Illuminate\Database\Eloquent\Builder;

class GameResultFilter extends Filter
{
    protected $key = 'result';

    public function buildQuery(Builder $query): Builder
    {
        return $query->whereRaw(sprintf('win %s bet', $this->getValue() == 'profitable' ? '>' : '<='));
    }
}
