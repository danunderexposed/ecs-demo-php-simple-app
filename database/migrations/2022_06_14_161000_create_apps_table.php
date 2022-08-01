<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('apps', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('app_id');
            $table->string('app_type');
            $table->unsignedBigInteger('school_id');
            $table->string('courses_exclude')->nullable();
            $table->boolean('hide_projects')->default(false);
            $table->boolean('show_course_index')->default(false);
            $table->string('graduation_year');
            $table->boolean('enable_year_filter')->default(false);
            $table->unsignedBigInteger('projects_per_page');
            $table->boolean('override_filters')->default(false);
            $table->json('filter_sectors')->nullable();
            $table->json('content_modules')->nullable();
            $table->string('index_title')->nullable();
            $table->text('index_text')->nullable();
            $table->string('listings_title')->nullable();
            $table->text('listings_text')->nullable();
            $table->boolean('capitalise_buttons')->default(false);
            $table->unsignedBigInteger('padding_left')->default(0);
            $table->unsignedBigInteger('padding_right')->default(0);
            $table->unsignedBigInteger('padding_top')->default(0);
            $table->unsignedBigInteger('padding_bottom')->default(0);
            $table->string('google_analytics')->nullable();
            $table->boolean('google_analytics_global')->default(false);

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
        Schema::dropIfExists('apps');
    }
}
