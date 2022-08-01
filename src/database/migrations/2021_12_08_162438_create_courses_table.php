<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCoursesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('courses', function (Blueprint $table) {
            $table->id();
            $table->string('email')->nullable();
            $table->string('name')->nullable();
            $table->string('slug')->nullable();
            $table->text('about')->nullable();
            $table->unsignedBigInteger('studylevel_id')->nullable()->default(null);
            $table->foreign('studylevel_id')->references('id')->on('study_levels');
            $table->text('division')->nullable();
            $table->text('address1')->nullable();
            $table->text('address2')->nullable();
            $table->string('postcode')->nullable();
            $table->string('leadertitle')->nullable();
            $table->string('leadername')->nullable();
            $table->string('contactemail')->nullable();
            $table->string('contacturl')->nullable();
            $table->string('admissionemail')->nullable();
            $table->string('admissionurl')->nullable();
            $table->string('tel')->nullable();
            $table->unsignedBigInteger('school_id');
            $table->foreign('school_id')->references('id')->on('schools');
            $table->unsignedBigInteger('sector')->nullable()->default(null);
            $table->foreign('sector')->references('id')->on('sectors');
            $table->unsignedBigInteger('sector2')->nullable()->default(null);
            $table->foreign('sector2')->references('id')->on('sectors');
            $table->unsignedBigInteger('sector3')->nullable()->default(null);
            $table->foreign('sector3')->references('id')->on('sectors');
            $table->unsignedBigInteger('specialism')->nullable()->default(null);
            $table->foreign('specialism')->references('id')->on('specialisms');
            $table->unsignedBigInteger('specialism2')->nullable()->default(null);
            $table->foreign('specialism2')->references('id')->on('specialisms');
            $table->unsignedBigInteger('specialism3')->nullable()->default(null);
            $table->foreign('specialism3')->references('id')->on('specialisms');
            $table->unsignedBigInteger('country_id')->nullable()->default(null);
            $table->foreign('country_id')->references('id')->on('countries');
            $table->unsignedBigInteger('city_id')->nullable()->default(null);
            $table->foreign('city_id')->references('id')->on('cities');

            $table->text('image')->nullable();
            $table->text('image_small')->nullable();
            $table->text('image_medium')->nullable();
            $table->string('website')->nullable();
            $table->boolean('active')->nullable();
            $table->string('profiledisplaytype')->nullable();
            $table->text('profiles')->nullable();
            $table->boolean('instagram_display')->default(false);
            $table->string('instagram_url')->nullable();
            $table->string('instagram_username')->nullable();
            $table->integer('courseorder')->nullable();
            $table->boolean('coursenotify')->default(false);
            $table->string('main_image_link')->nullable();
            $table->string('logo_link')->nullable();


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
        Schema::dropIfExists('courses');
    }
}
