<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   GetUser.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class GetUser extends FormRequest
{
    
    public function authorize()
    {
        
        return $this->user && ($this->user->is_active || $this->user()->is_admin);
    }

    
    public function rules()
    {
        return [
            
        ];
    }
}
