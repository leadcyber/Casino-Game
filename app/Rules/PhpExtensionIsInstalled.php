<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   PhpExtensionIsInstalled.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Rules;

use Illuminate\Contracts\Validation\Rule;

class PhpExtensionIsInstalled implements Rule
{
    private $extension;

    
    public function __construct(string $extension)
    {
        $this->extension = $extension;
    }

    
    public function passes($attribute = NULL, $value = NULL)
    {
        return extension_loaded($this->extension);
    }

    
    public function message()
    {
        return __('PHP extension ":ext" should be installed and enabled on your server.', ['ext' => $this->extension]);
    }
}
