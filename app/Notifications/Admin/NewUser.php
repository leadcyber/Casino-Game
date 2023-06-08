<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   NewUser.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Notifications\Admin;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Notifications\Messages\MailMessage;

class NewUser extends AdminNotification
{
    protected $user;

    
    public function __construct(Authenticatable $game)
    {
        parent::__construct();

        $this->user = $game;
    }

    
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject(__('New user signed up'))
            ->greeting(__('Hello'))
            ->line(__('New user :name (:email) has just signed up.', ['name' => $this->user->name, 'email' => $this->user->email]))
            ->action(__('View user'), url(sprintf('admin/users/%d', $this->user->id)));
    }
}
