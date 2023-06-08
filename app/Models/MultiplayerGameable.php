<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   MultiplayerGameable.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

trait MultiplayerGameable
{
    use StandardDateFormat;

    
    public function multiplayerGame(): MorphOne
    {
        return $this->morphOne(MultiplayerGame::class, 'gameable');
    }
}
