<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   AdminNotification.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Notifications\Admin;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class AdminNotification extends Notification
{
    use Queueable;

    public function __construct()
    {
        
        $this->locale(config('app.default_locale'));
    }

    
    public function via($notifiable)
    {
        return ['mail'];
    }

    
    public function toArray($notifiable)
    {
        return [
            
        ];
    }
}
