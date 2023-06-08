<?php
/**
 *   Stake iGaming platform
 *   ----------------------
 *   2023_03_03_000000_alter_users_table_add_fields.php
 * 
 *   @copyright  Copyright (c) Casino, All rights reserved
 *   @author     Casino <info@casino.com>
 *   @see        https://casino.com
*/

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AlterUsersTableAddFields extends Migration
{
    
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->json('fields')->nullable()->after('status');
        });
    }

    
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn('fields');
        });
    }
}
