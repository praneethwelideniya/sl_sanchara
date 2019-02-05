<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterTableImages01 extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('images', function($table) {
            $table->integer('user_id');
            $table->enum('img_type', ['profile', 'cover','article','other'])->default('other');
        });  
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('images', function($table) {
            $table->dropColumn('user_id');
            $table->dropColumn('img_type');
        });    
    }
}
