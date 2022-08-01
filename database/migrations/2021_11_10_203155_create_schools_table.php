<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSchoolsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('schools', function (Blueprint $table) {
            $table->id();
            $table->string('slug')->nullable();
            $table->unsignedBigInteger('country_id')->nullable()->default(null);
            $table->foreign('country_id')->references('id')->on('cities');
            $table->unsignedBigInteger('city_id')->nullable()->default(null);
            $table->foreign('city_id')->references('id')->on('cities');
            $table->string('school')->nullable();
            $table->string('image')->nullable();
            $table->string('image_medium')->nullable();
            $table->string('image_small')->nullable();
            $table->string('slider')->nullable();
            $table->string('slider_medium')->nullable();
            $table->string('slider_small')->nullable();
            $table->text('excerpt')->nullable();
            $table->text('description')->nullable();
            $table->string('website')->nullable();
            $table->string('twitter')->nullable();
            $table->string('facebook')->nullable();
            $table->string('linkedin')->nullable();
            $table->string('youtube')->nullable();
            $table->string('instagram')->nullable();
            $table->string('vimeo')->nullable();
            $table->string('pinterest')->nullable();
            $table->boolean('featured')->nullable();
            $table->boolean('separate')->nullable();
            $table->boolean('display_instagram')->nullable();
            $table->string('instagram_user')->nullable();
            $table->string('instagram_title')->nullable();
            $table->string('displaytype')->nullable();

            // required?
            $table->text('profiles')->nullable();
            $table->text('projects')->nullable();
            $table->text('courses')->nullable();

            $table->unsignedInteger('schoolorder')->nullable();

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
        Schema::dropIfExists('schools');
    }
}
