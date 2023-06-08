<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   AffiliateCommissionTypeFilter.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Helpers\Queries\Filters;

use App\Models\AffiliateCommission;

class AffiliateCommissionTypeFilter extends EnumFilter
{
    protected $key = 'type';
    protected $model = AffiliateCommission::class;
    protected $table = 'affiliate_commissions';
}
