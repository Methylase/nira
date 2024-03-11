<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateProfilesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('profiles', function (Blueprint $table) {
            $table->increments('id');
            $table->string('profile_image');
            $table->string('firstname');
            $table->string('middlename');
            $table->string('lastname');            
            $table->string('marital_status');
            $table->string('gender');            
            $table->string('phone_number');
            $table->string('dob');
            $table->string('hobbies');
            $table->string('address_1');
            $table->string('address_2');
            $table->string('city');
            $table->string('state');
            $table->string('localG');
            $table->string('country');
            $table->string('postalCode');
            $table->integer('user_id')->unsigned()->nullable();
        });
         Schema::table('profiles', function (Blueprint $table) {
              $table->foreign('user_id')->references('id')->on('users');
         });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('register_parent_informations');
    }
}
