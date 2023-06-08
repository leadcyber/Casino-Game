<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   EventServiceProvider.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Providers;

use App\Events\GamePlayed;
use App\Listeners\AffiliateEventSubscriber;
use App\Listeners\BonusSubscriber;
use App\Listeners\NotificationSubscriber;
use App\Services\Oauth\TwitterExtendSocialite;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use SocialiteProviders\Coinbase\CoinbaseExtendSocialite;
use SocialiteProviders\Manager\SocialiteWasCalled;
use SocialiteProviders\Yahoo\YahooExtendSocialite;

class EventServiceProvider extends ServiceProvider
{
    
    protected $listen = [
        SocialiteWasCalled::class => [
            YahooExtendSocialite::class,
            CoinbaseExtendSocialite::class,
            TwitterExtendSocialite::class
        ],
        Registered::class => [
            
        ],
        GamePlayed::class => [
            
        ],
    ];

    
    protected $subscribe = [
        AffiliateEventSubscriber::class,
        BonusSubscriber::class,
        NotificationSubscriber::class,
    ];
}
