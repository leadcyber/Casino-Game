<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   AccountDebit.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Http\Requests\Admin;

use Illuminate\Foundation\Http\FormRequest;

class AccountDebit extends FormRequest
{
    
    public function authorize()
    {
        return TRUE;
    }

    
    public function rules()
    {


        return [
            'amount' => 'required|numeric|min:1|max:' . $this->account->balance
        ];
    }
}
