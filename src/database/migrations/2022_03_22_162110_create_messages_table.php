<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('messages', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('userid')->nullable();
            $table->foreign('userid')->references('id')->on('users');
            $table->string('useremail');
            $table->string('username');
            $table->unsignedBigInteger('messagerid')->nullable();
            $table->foreign('messagerid')->references('id')->on('users');
            $table->string('messageremail');
            $table->string('messagername');
            $table->string('subject');
            $table->string('category');
            $table->text('message');
            $table->string('ip')->nullable();
            $table->date('sentdate');
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
        Schema::dropIfExists('messages');
    }
}
