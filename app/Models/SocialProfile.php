<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   SocialProfile.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SocialProfile extends Model
{
    use StandardDateFormat;

    
    protected $fillable = [
        'user_id', 'provider_name', 'provider_user_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
