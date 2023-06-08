<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   TwitterExtendSocialite.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Services\Oauth;

use SocialiteProviders\Manager\SocialiteWasCalled;

class TwitterExtendSocialite
{
    public function handle(SocialiteWasCalled $socialiteWasCalled)
    {
        $socialiteWasCalled->extendSocialite('twitter', TwitterProvider::class);
    }
}
