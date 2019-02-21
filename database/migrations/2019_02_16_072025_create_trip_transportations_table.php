<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateTripTransportationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('trip_transportations', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('transpotation_type_id')->unsigned();
            $table->integer('trip_activity_id')->unsigned();
            $table->string('start_location');
            $table->string('end_location');
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
        Schema::dropIfExists('trip_transportations');
    }
}
