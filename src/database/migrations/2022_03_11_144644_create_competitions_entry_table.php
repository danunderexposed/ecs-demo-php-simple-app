<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompetitionsEntryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competitions_entry', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('compid')->nullable();
            $table->foreign('compid')->references('id')->on('competitions');
            $table->unsignedBigInteger('userid')->nullable();
            $table->foreign('userid')->references('id')->on('users');
            $table->date('entered');
            $table->unsignedBigInteger('projectid')->nullable();
            //$table->foreign('userid')->references('id')->on('users');
            $table->unsignedBigInteger('category')->nullable();
            $table->boolean('winner')->default(false);
            $table->boolean('shortlist')->default(false);
            $table->boolean('runnerup')->default(false);
            $table->boolean('popular')->default(false);
            $table->boolean('voting')->default(false);
            $table->unsignedBigInteger('totalvotes')->default(0);
            $table->unsignedBigInteger('specialism_id')->nullable();

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
        Schema::dropIfExists('competitions_entry');
    }
}
