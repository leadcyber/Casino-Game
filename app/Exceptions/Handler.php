<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   Handler.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Exceptions;

use Illuminate\Foundation\Exceptions\Handler as ExceptionHandler;
use Throwable;

class Handler extends ExceptionHandler
{
    
    protected $dontReport = [
        
    ];

    
    protected $dontFlash = [
        'password',
        'password_confirmation',
    ];

    
    public function report(Throwable $exception)
    {
        parent::report($exception);
    }

    
    public function render($request, Throwable $exception)
    {
        return parent::render($request, $exception);
    }
}
