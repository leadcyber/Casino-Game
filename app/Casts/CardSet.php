<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   CardSet.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Casts;

use Illuminate\Contracts\Database\Eloquent\CastsAttributes;

class CardSet implements CastsAttributes
{
    public function get($model, $key, $value, $attributes)
    {
        return new \App\Helpers\Games\CardSet(json_decode($value));
    }

    public function set($model, $key, $value, $attributes)
    {
        return json_encode(is_array($value) ? $value : $value->toArray());
    }
}
