<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   GetGameRooms.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Http\Requests;

use App\Helpers\PackageManager;
use Illuminate\Foundation\Http\FormRequest;

class GetGameRooms extends FormRequest
{
    
    public function authorize(PackageManager $packageManager)
    {
        $package = $packageManager->get($this->packageId);

        return !!$package && $package->enabled;
    }

    
    public function rules()
    {
        return [
            
        ];
    }
}
