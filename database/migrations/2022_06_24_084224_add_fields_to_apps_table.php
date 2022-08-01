<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddFieldsToAppsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('apps', function (Blueprint $table) {
            $table->unsignedBigInteger('school_id')->default(null)->change();
            $table->unsignedBigInteger('event_id')->after('school_id')->default(null);
            $table->unsignedBigInteger('competition_id')->after('school_id')->default(null);
            $table->boolean('allow_voting')->default(false);
            $table->json('school_filters')->nullable();
            $table->json('filters_override')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('apps', function (Blueprint $table) {
            $table->drop('event_id');
            $table->drop('competition_id');
            $table->drop('allow_voting');
            $table->drop('filters_override');
            $table->drop('school_filters');
        });
    }
}
