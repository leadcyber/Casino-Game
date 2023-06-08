<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   PasswordIsCorrect.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Rules;

use App\Models\User;
use Illuminate\Contracts\Validation\Rule;
use Illuminate\Support\Facades\Hash;

class PasswordIsCorrect implements Rule
{
    private $user;

    
    public function __construct(User $user)
    {
        $this->user = $user;
    }

    
    public function passes($attribute, $value)
    {
        return $value && Hash::check($value, $this->user->password);
    }

    
    public function message()
    {
        return __('The current password is incorrect.');
    }
}
