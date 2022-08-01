<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCompetitionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('competitions', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('name');
            $table->string('link')->nullable();
            $table->text('description');
            $table->string('image')->nullable();
            $table->string('image_medium')->nullable();
            $table->string('image_small')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date');
            $table->boolean('active')->default(false);
            $table->boolean('entrydisplay')->default(false);
            $table->boolean('entrydisplayvote')->default(false);
            $table->string('entrytitle')->nullable();
            $table->boolean('featured')->default(false);
            $table->boolean('displayads')->default(false);
            $table->boolean('displaycomps')->default(false);
            $table->boolean('displayfilters')->default(false);
            $table->boolean('winnerdisplay')->default(false);
            $table->string('winnertitle')->nullable();
            $table->boolean('hidedetails')->default(false);
            $table->boolean('preview')->default(false);
            $table->text('preview_description')->nullable();
            $table->boolean('preview_displayentry')->default(false);
            $table->boolean('preview_displaycomps')->default(false);
            $table->boolean('preview_displayads')->default(false);
            $table->boolean('preview_displaywinners')->default(false);
            $table->boolean('preview_hidedetails')->default(false);
            $table->boolean('onlyportfolio')->default(false);
            $table->string('status')->nullable();
            $table->date('deadline')->nullable();
            $table->date('votestart')->nullable();
            $table->date('voteend')->nullable();
            $table->boolean('voteoverride')->default(false);
            $table->date('winnerdate')->nullable();
            $table->text('headexcerpt')->nullable();
            $table->boolean('profiledisplay')->default(false);
            $table->unsignedBigInteger('comporder')->default(0);

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
        Schema::dropIfExists('competitions');
    }
}
