<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddLegacyFieldsToUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('legacy_password')->nullable();
            $table->string('legacy_salt')->nullable();
            $table->string('legacy_verifycode')->nullable();

            // extra AT fields... TBD


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
            $table->dropColumn(['legacy_password', 'legacy_salt', 'legacy_verifycode']);
        });
    }
}
