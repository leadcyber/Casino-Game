<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   2021_12_03_000000_create_cache_table.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCacheTable extends Migration
{
    
    public function up()
    {
        Schema::create('cache', function (Blueprint $table) {
            $table->string('key')->unique();
            $table->text('value');
            $table->integer('expiration');
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('cache');
    }
}
