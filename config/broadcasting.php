<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   broadcasting.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

return [

    

    'default' => env('BROADCAST_DRIVER', 'pusher'),

    

    'connections' => [

        'pusher' => [
            'driver' => 'pusher',
            'app_id' => env('PUSHER_APP_ID'),
            'key' => env('PUSHER_APP_KEY'),
            'secret' => env('PUSHER_APP_SECRET'),
            'options' => [
                'cluster' => env('PUSHER_APP_CLUSTER', 'eu'),
                'encrypted' => TRUE,
                'useTLS' => TRUE,
            ],
        ],

        'redis' => [
            'driver' => 'redis',
            'connection' => 'default',
        ],

        'log' => [
            'driver' => 'log',
        ],

        'null' => [
            'driver' => 'null',
        ],

    ],

];
