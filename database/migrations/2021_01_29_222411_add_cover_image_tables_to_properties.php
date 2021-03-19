<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddCoverImageTablesToProperties extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->string('cover_image1');
            $table->string('cover_image2');
            $table->string('cover_image3');
            $table->string('cover_image4');
            $table->string('cover_image5');
            $table->string('cover_image6');
            $table->string('cover_image7');
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
            $table->dropColumn('cover_image');
        });
    }
}
