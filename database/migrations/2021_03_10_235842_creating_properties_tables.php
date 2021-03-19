<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatingPropertiesTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('properties', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->uuid('user_id');
            $table->string('price');
            $table->string('header');
            $table->string('property_type');
            $table->integer('number_of_baths');
            $table->integer('number_of_rooms');
            $table->string('post_code');
            $table->mediumText('Description');
            $table->mediumText('address');
            $table->string('features');
            $table->string('City');
            $table->string('region');
            $table->float('longitude');
            $table->float('latitude');
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
        