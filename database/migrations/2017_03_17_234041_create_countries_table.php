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
            $table->integer('continent_id')->nullable();
            $table->string('code')->nullable();
            $table->string('name')->nullable();
            $table->string('flag')->nullable();
            $table->string('fips_code')->nullable();
            $table->string('iso_code')->nullable();
            $table->string('north_num')->nullable();
            $table->string('south_num')->nullable();
            $table->string('east_num')->nullable();
            $table->string('west_num')->nullable();
            $table->string('capital')->nullable();
            $table->string('iso_alpha_2')->nullable();
            $table->string('iso_alpha_3')->nullable();
            $table->string('geoname_id')->nullable();
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
