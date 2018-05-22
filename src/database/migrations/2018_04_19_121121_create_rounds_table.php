<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateRoundsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rounds', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('user_id');
            $table->string('author');
            $table->string('genre');
            $table->string('title');
            $table->string('description');
            $table->string('city');
            $table->string('start_pos_lat');
            $table->string('start_pos_long');
            $table->integer('start_datapoint_id')->nullable();
            $table->integer('image_id')->nullable();
            $table->string('language')->default('NA');
            $table->boolean('finished')->default(false);
            $table->boolean('published')->default(false);
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
        Schema::dropIfExists('rounds');
    }
}
