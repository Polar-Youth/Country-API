<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // TODO: Register factory.
        
        Schema::create('languages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('iso_639_1')->nullable();
            $table->string('iso_639_2')->nullable();
            $table->string('iso_639_3')->nullable();
            $table->string('name')->nullable();
            $table->string('name_global')->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('languages');
    }
}
