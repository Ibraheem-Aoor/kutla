<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdanTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adan', function (Blueprint $table) {
            $table->increments('id');
            $table->date('date')->nullable();
            $table->time('daybreak')->nullable();
            $table->time('daybreak1')->nullable();
            $table->time('noon')->nullable();
            $table->time('noon1')->nullable();
            $table->time('afternoon')->nullable();
            $table->time('afternoon1')->nullable();
            $table->time('sunset')->nullable();
            $table->time('sunset1')->nullable();
            $table->time('night')->nullable();
            $table->time('night1')->nullable();
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
        Schema::dropIfExists('adan');
    }
}
