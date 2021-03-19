<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddListingTypeToPropertiesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->string('features');
            $table->string('listing_type');
            $table->integer('City');
            $table->string('region');
            $table->string('longitude');
            $table->integer('latitude');
            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropIfExists('listing_type');
            $table->dropIfExists('City');
            $table->dropIfExists('longitude');
            $table->dropIfExists('region');
            $table->dropIfExists('latitude');
        });
    }
}
