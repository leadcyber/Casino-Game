<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   VerifyEmail.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Notifications;

use Illuminate\Auth\Notifications\VerifyEmail as Notification;

class VerifyEmail extends Notification
{
    
    protected function verificationUrl($notifiable)
    {
        $url = parent::verificationUrl($notifiable);

        return str_replace('/api', '', $url);
    }
}
