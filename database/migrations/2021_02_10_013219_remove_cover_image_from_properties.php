<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class RemoveCoverImageFromProperties extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('properties', function (Blueprint $table) {
            $table->dropColumn('cover_image');
            $table->dropColumn('cover_image1');
            $table->dropColumn('cover_image2');
            $table->dropColumn('cover_image3');
            $table->dropColumn('cover_image4');
            $table->dropColumn('cover_image5');
            $table->dropColumn('cover_image6');
            $table->dropColumn('cover_image7');
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
            //
        });
    }
}
