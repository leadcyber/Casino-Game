<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   2019_11_02_000000_create_provably_fair_games_table.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProvablyFairGamesTable extends Migration
{
    
    public function up()
    {
        Schema::create('provably_fair_games', function (Blueprint $table) {
            
            $table->bigIncrements('id');
            $table->string('secret', 500); 
            $table->string('server_seed', 32); 
            $table->string('hash', 64); 
            $table->string('client_seed', 32);
            $table->string('gameable_type');
            $table->timestamps();
            
            $table->unique(['hash', 'gameable_type']);
            $table->index('created_at');
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('provably_fair_games');
    }
}
