<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompetitionsCatassignTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competitions_catassign', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('compid');
            $table->foreign('compid')->references('id')->on('competitions');
            $table->unsignedBigInteger('catid');
            $table->foreign('catid')->references('id')->on('competition_categories');
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
        Schema::dropIfExists('competitions_catassign');
    }
}
