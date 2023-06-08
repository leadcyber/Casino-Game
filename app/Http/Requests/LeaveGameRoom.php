<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   LeaveGameRoom.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Http\Requests;

use App\Helpers\PackageManager;
use App\Models\GameRoom;
use App\Rules\UserJoinedGameRoomAndNotPlaying;
use Illuminate\Foundation\Http\FormRequest;

class LeaveGameRoom extends FormRequest
{
    
    public function authorize(PackageManager $packageManager)
    {
        $package = $packageManager->get($this->packageId);

        return !!$package && $package->enabled;
    }

    
    public function rules()
    {
        GameRoom::where('id', intval($this->room_id))->open()->firstOrFail();

        return [
            'room_id' => [
                new UserJoinedGameRoomAndNotPlaying($this->user()) 
            ]
        ];
    }
}
