<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFacebookFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['oldcompetitions', 'oldurl', 'olduserid']);
        });
        Schema::table('users', function (Blueprint $table) {
         //   $table->string('facebook_id')->nullable();

            $table->string('facebook_token')->nullable();
            $table->string('facebook_refresh_token')->nullable();

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['facebook_id', 'facebook_token', 'facebook_refresh_token']);
        });
    }
}
