<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id'); // becomes automatically the primary key
            $table->string('password');
            $table->string('email')->unique();
            $table->string('org_nr');
            $table->string('company_name');
            $table->string('name');
            $table->boolean('is_admin')->default(false);
            $table->rememberToken(); // token so that you can choose "remember me" option on website
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
        Schema::dropIfExists('users');
    }
}
