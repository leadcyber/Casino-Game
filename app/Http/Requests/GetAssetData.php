<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   GetAssetData.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetAssetData extends FormRequest
{
    
    public function authorize()
    {
        return $this->asset->is_active;
    }

    
    public function rules()
    {
        return [
            
        ];
    }
}
