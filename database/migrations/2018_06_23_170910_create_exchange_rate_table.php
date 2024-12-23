<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateExchangeRateTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exchange_rate', function (Blueprint $table) {
            $table->increments('id');
            $table->date('today')->nullable();
            $table->float('usd')->nullable();
            $table->float('jod')->nullable();
            $table->float('egp')->nullable();
            $table->float('eur')->nullable();
            $table->timestamps();
        });
        Schema::create('weather', function (Blueprint $table) {
            $table->increments('id');
            $table->date('weather_date')->nullable();
            $table->integer('high')->nullable();
            $table->integer('low')->nullable();
            $table->string('type')->nullable();
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
        Schema::dropIfExists('exchange_rate');
    }
}
