<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   ChatMessageRepository.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Repositories;

use App\Events\ChatMessageSent;
use App\Models\ChatMessage;
use App\Models\ChatRoom;
use App\Models\User;

class ChatMessageRepository
{
    public function create(ChatRoom $room, User $sender, string $message, array $recipients = [])
    {
        $chatMessage = new ChatMessage();
        $chatMessage->room()->associate($room);
        $chatMessage->user()->associate($sender);
        $chatMessage->message = $message;
        $chatMessage->save();

        if (!empty($recipients)) {
            $chatMessage->recipients()->attach($recipients);
        }

        broadcast(new ChatMessageSent($room, $chatMessage));

        return $chatMessage;
    }
}
