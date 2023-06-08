<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   ProvableGame.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/


namespace App\Models;

interface ProvableGame
{
    
    public function getSecretAttributeAttribute(): string;

    
    public function getSecretAttributeHintAttribute(): string;
}
