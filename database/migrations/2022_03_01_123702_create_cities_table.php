<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCitiesTable extends Migration
{
   
    public function up()
    {
        Schema::create('cities', function (Blueprint $table) {
            $table->id();
            $table->string('city_name');
            $table->string('city_id');
            $table->string('lat');
            $table->string('long');
            $table->string('weather');
            $table->double('temprature');
            $table->string('feels_like');
            $table->string('humidity');
            $table->string('wind_speed');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cities');
    }
}
