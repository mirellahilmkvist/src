<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateDatapointsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('datapoints', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('round_id');
            $table->string('title');
            $table->string('text');
            $table->boolean('is_direction')->default(false);
            $table->string('point_pos_lat');
            $table->string('point_pos_long');
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
        Schema::dropIfExists('datapoints');
    }
}
