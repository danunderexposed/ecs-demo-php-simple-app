<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->string('slug')->nullable();
            $table->string('title')->nullable();
            $table->text('description')->nullable();
            $table->string('cover_small')->nullable();
            $table->string('cover_medium')->nullable();
            $table->string('cover_large')->nullable();
            $table->boolean('display')->default(false);
            $table->string('type')->nullable();
            $table->unsignedBigInteger('specialism')->nullable();
            $table->unsignedBigInteger('specialism2')->nullable();
            $table->unsignedBigInteger('specialism3')->nullable();
            $table->unsignedBigInteger('sort_order')->nullable();
            $table->unsignedBigInteger('oldgalleryid')->nullable();
            $table->unsignedBigInteger('views')->default(0);
            $table->unsignedBigInteger('likes')->default(0);
            $table->unsignedBigInteger('comments')->default(0);
            $table->string('ytag_link')->nullable();

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
        Schema::dropIfExists('projects');
    }
}
