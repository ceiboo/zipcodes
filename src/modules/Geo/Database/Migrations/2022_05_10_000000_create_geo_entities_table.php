<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGeoEntitiesTable extends Migration
{
    public function up()
    {
        Schema::create('geo_entities', function (Blueprint $table) {
            $table->id();
            $table->string('name', 255);
            $table->smallInteger('key');
            $table->string('code', 20)->nullable();
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
        Schema::dropIfExists('geo_entity');
    }
}
