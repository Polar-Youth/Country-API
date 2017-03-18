<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCountriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('countries', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('continent_id');
            $table->string('code');
            $table->string('name');
            $table->string('flag');
            $table->string('fips_code');
            $table->string('iso_code');
            $table->string('north_num');
            $table->string('south_num');
            $table->string('east_num');
            $table->string('west_num');
            $table->string('capital');
            $table->string('iso_alpha_2');
            $table->string('iso_alpha_3');
            $table->string('geoname_id');
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
        Schema::dropIfExists('countries');
    }
}
