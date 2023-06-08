<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   auth.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

return [

    

    'defaults' => [
        'guard' => 'web',
        'passwords' => 'users',
    ],

    

    'guards' => [
        'web' => [
            'driver' => 'session',
            'provider' => 'users',
        ],

        'api' => [
            'driver' => 'token',
            'provider' => 'users',
            'hash' => false,
        ],
    ],

    

    'providers' => [
        'users' => [
            'driver' => 'eloquent',
            'model' => App\Models\User::class,
        ],

        
        
        
        
    ],

    

    'passwords' => [
        'users' => [
            'provider' => 'users',
            'table' => 'password_resets',
            'expire' => 60,
            'throttle' => 60,
        ],
    ],

    

    'password_timeout' => 10800,

    'web3' => [
        'metamask' => [
            'blockchain' => 'evm',
            'enabled' => env('AUTH_WEB3_METAMASK_ENABLED', FALSE),
        ],
        'phantom' => [
            'blockchain' => 'solana',
            'enabled' => env('AUTH_WEB3_PHANTOM_ENABLED', FALSE),
        ],
        'tronlink' => [
            'blockchain' => 'tron',
            'enabled' => env('AUTH_WEB3_TRONLINK_ENABLED', FALSE),
        ],
    ]
];
