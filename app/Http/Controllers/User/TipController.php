<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   TipController.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

namespace App\Http\Controllers\User;

use App\Facades\AccountTransaction;
use App\Http\Requests\SendTip;
use App\Http\Controllers\Controller;
use App\Models\GenericAccountTransaction;
use App\Models\User;

class TipController extends Controller
{
    public function send(SendTip $request, User $user)
    {
        AccountTransaction::createGeneric($request->user()->account, GenericAccountTransaction::TYPE_TIP, -$request->amount);
        AccountTransaction::createGeneric($user->account, GenericAccountTransaction::TYPE_TIP, $request->amount);

        return $this->successResponse(['user' => $request->user()->loadMissing('account')]);
    }
}
