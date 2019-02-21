<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripActivitiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_activities', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('trip_id')->unsiged();
            $table->string('activity_type');
            $table->text('description');
            $table->string('cost');
            $table->dateTime('start');
            $table->dateTime('end');
            $table->integer('trip_option');
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
        Schema::dropIfExists('trip_activities');
    }
}
