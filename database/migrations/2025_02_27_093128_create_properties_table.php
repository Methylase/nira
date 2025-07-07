<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->increments('id');
            $table->text('address');
            $table->string('amount');
            $table->string('area');
            $table->string('bed');
            $table->string('baths');
            $table->string('state');
            $table->string('localG');
            $table->string('postalCode');
            $table->string('type');
            $table->string('description');
            $table->string('status')->nullable();
            $table->text('amenities');
            $table->string('garage');
            $table->string('image');
            $table->string('video')->nullable();
            $table->string('map')->nullable();
            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('properties');
    }
}
