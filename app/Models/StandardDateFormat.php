<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   StandardDateFormat.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Models;

use DateTimeInterface;

trait StandardDateFormat
{
    
    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }
}
