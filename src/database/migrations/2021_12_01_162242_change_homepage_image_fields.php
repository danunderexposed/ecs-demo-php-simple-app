<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangeHomepageImageFields extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('homepage', function (Blueprint $table) {
            $table->text('image')->change();
            $table->text('mobile_image')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('homepage', function (Blueprint $table) {
            $table->string('image')->change();
            $table->string('mobile_image')->change();
        });
    }
}
