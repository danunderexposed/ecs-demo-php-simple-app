<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateEventsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('slug');
            $table->string('name')->nullable();
            $table->string('link')->nullable();
            $table->text('description')->nullable();
            $table->string('image')->nullable();
            $table->string('image_medium')->nullable();
            $table->string('image_small')->nullable();
            $table->date('start_date')->nullable();
            $table->date('end_date');
            $table->boolean('active')->default(true);
            $table->boolean('entrydisplay')->default(false);
            $table->boolean('featured')->default(false);
            $table->boolean('displayads')->default(true);
            $table->boolean('displayevent')->default(true);
            $table->boolean('useradd')->default(true);
            $table->unsignedBigInteger('eventorder')->default(0);
            $table->boolean('approvalrequired')->default(false);
            $table->boolean('is_hidden')->default(false);

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
        Schema::dropIfExists('events');
    }
}
