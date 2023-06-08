<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   Job.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    use DefaultTimestampsAgoAttributes;
    use HasFactory;

    protected $casts = [
        'payload' => 'collection'
    ];

    protected $dates = [
        'available_at', 'reserved_at:'
    ];

    protected $appends = ['created_ago'];
}
