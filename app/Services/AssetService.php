<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   AssetService.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Services;

class AssetService
{
    protected $api;

    public function __construct(AssetApi $api)
    {
        $this->api = $api;
    }
}
