<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   PackageServiceProvider.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace Packages\Baccarat\Providers;

use App\Providers\PackageServiceProvider as DefaultPackageServiceProvider;

class PackageServiceProvider extends DefaultPackageServiceProvider
{
    protected $packageId = 'baccarat';
}
