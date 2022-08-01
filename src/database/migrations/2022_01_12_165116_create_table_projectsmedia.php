<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTableProjectsmedia extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects_media', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('project_id');
            $table->foreign('project_id')->references('id')->on('projects');
            $table->string('slug')->nullable();
            $table->string('title')->nullable();
            $table->string('description')->nullable();
            $table->string('type')->nullable();

            $table->boolean('display')->default(false);
            $table->unsignedBigInteger('sort_order');
            $table->string('image_small')->nullable();
            $table->string('image_medium')->nullable();
            $table->string('image_large')->nullable();
            $table->string('vidurl')->nullable();

            $table->unsignedBigInteger('oldmediaid')->nullable();

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
        Schema::dropIfExists('projects_media');
    }
}
