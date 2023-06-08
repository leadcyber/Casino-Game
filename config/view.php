<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   view.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

return [

    

    'paths' => [
        resource_path('views'),
    ],

    

    'compiled' => env(
        'VIEW_COMPILED_PATH',
        realpath(storage_path('framework/views'))
    ),

];
