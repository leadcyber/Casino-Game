<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   2020_01_20_000000_create_chat_rooms_table.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateChatRoomsTable extends Migration
{
    
    public function up()
    {
        Schema::create('chat_rooms', function (Blueprint $table) {
            
            $table->bigIncrements('id');
            $table->string('name', 50);
            $table->boolean('enabled')->default(TRUE);
            $table->timestamps();
            
            $table->index('enabled');
        });
    }

    
    public function down()
    {
        Schema::dropIfExists('chat_rooms');
    }
}
