<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   ChatMessageController.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Http\Controllers\Admin;

use App\Helpers\Queries\ChatMessageQuery;
use App\Http\Controllers\Controller;
use App\Models\ChatMessage;
use Illuminate\Http\Request;

class ChatMessageController extends Controller
{
    public function index(ChatMessageQuery $query)
    {
        $items = $query
            ->get()
            ->map(function ($account) {
                $account->user->makeVisible('referrer');
                $account->user->append('two_factor_auth_enabled', 'two_factor_auth_passed', 'is_admin', 'is_bot', 'is_active');
                return $account;
            });

        return [
            'count' => $query->getRowsCount(),
            'items' => $items
        ];
    }

    public function destroy(ChatMessage $message)
    {
        return $message->delete();
    }
}
