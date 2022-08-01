<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateHomepageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('homepage', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('type');
            $table->string('image')->nullable();
            $table->string('link')->nullable();
            $table->text('headtxt')->nullable();
            $table->string('headclr')->nullable();
            $table->string('headbg')->nullable();
            $table->text('copytxt')->nullable();
            $table->string('copyclr')->nullable();
            $table->string('copybg')->nullable();
            $table->string('modulebg')->nullable();
            $table->string('videoid')->nullable();
            $table->string('videotype')->nullable();
            $table->string('mobile_image')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('homepage');
    }
}
