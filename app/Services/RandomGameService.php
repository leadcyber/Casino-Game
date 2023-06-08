<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   RandomGameService.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Services;

use App\Models\User;

interface RandomGameService
{
    
    public static function createRandomGame(User $user): void;
}
