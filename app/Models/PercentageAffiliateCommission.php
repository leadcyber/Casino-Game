<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   PercentageAffiliateCommission.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Models;

interface PercentageAffiliateCommission
{
    
    public function getAffiliateCommissionBaseAmount(): float;
}
