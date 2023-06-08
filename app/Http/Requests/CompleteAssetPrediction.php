<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   CompleteAssetPrediction.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Carbon;

class CompleteAssetPrediction extends FormRequest
{
    
    public function authorize()
    {
        return $this->game->is_in_progress
            && $this->game->account->id == $this->user()->account->id
            && $this->game->gameable->end_time->lte(Carbon::now());
    }

    
    public function rules()
    {
        return [];
    }
}
