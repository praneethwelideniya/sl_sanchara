<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripPlacesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_places', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('place_id')->nullable();
            $table->integer('activity_id')->unsigned()->nullable();
            $table->string('place_name');
            $table->string('lat_lon')->nullable();
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
        Schema::dropIfExists('trip_places');
    }
}
