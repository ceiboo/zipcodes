<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeoSettlementsTable extends Migration
{
    public function up()
    {
        Schema::create('geo_settlements', function (Blueprint $table) {
            $table->id();
            $table->foreignId('city_id')
            ->constrained('geo_cities')
            ->cascadeOnDelete();
            $table->string('zip_code', 5);
            $table->smallInteger('key');
            $table->string('name', 255);
            $table->string('zone_type', 25);
            $table->string('type', 25);
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
