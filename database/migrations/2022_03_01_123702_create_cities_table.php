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
            $table->string('lat')->nullable();
            $table->string('long')->nullable();
            $table->string('weather')->nullable();
            $table->string('temprature')->nullable();
            $table->string('feels_like')->nullable();
            $table->string('humidity')->nullable();
            $table->string('wind_speed')->nullable();
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::dropIfExists('cities');
    }
}
