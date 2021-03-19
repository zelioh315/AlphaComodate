<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePropertiesForRentTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties_for_rent', function (Blueprint $table) {
            $table->id('id');
            $table->string('monthly_price');
            $table->string('header');
            $table->string('property_type');
            $table->integer('number_of_baths');
            $table->integer('number_of_rooms');
            $table->string('post_code');
            $table->mediumText('Description');
            $table->mediumText('address');
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
        Schema::dropIfExists('properties_for_rent');
    }
}
