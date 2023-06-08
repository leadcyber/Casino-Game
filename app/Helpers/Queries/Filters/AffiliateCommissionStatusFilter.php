<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   AffiliateCommissionStatusFilter.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Helpers\Queries\Filters;

use App\Models\AffiliateCommission;

class AffiliateCommissionStatusFilter extends EnumFilter
{
    protected $key = 'status';
    protected $model = AffiliateCommission::class;
    protected $table = 'affiliate_commissions';
}
