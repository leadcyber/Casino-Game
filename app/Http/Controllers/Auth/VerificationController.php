<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   VerificationController.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Http\Controllers\Auth;

use App\Repositories\UserRepository;
use Illuminate\Foundation\Auth\VerifiesEmails;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class VerificationController extends Controller
{
    

    use VerifiesEmails;

    
    public function __construct()
    {
        $this->middleware('signed')->only('verify');
        $this->middleware('throttle:6,1')->only('verify', 'resend');
    }

    
    protected function verified(Request $request)
    {
        return UserRepository::load($request->user());
    }
}
