<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   web.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/



use Illuminate\Support\Facades\Route;
use App\Http\Controllers\PageController;

Route::get('{path}', [PageController::class, 'index'])->where('path', '.*')->middleware('referrer');
