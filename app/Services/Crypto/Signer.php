<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   Signer.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Services\Crypto;

interface Signer
{
    public function sign(string $privateKey, string $message): string;

    public function verify(string $message, string $signature, string $address): bool;
}
