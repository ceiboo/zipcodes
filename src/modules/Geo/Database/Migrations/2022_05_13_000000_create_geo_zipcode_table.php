<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeoZipcodeTable extends Migration
{
    public function up()
    {
        Schema::create('geo_zipcode', function (Blueprint $table) {
            $table->id();
            $table->string('zip_code', 5);
            $table->text('jsondata');
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('geo_cities');
    }
}
