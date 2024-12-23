<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('adv_settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('page')->nullable();
            $table->integer('adv_part_1')->nullable();
            $table->integer('adv_part_2')->nullable();
            $table->integer('adv_part_3')->nullable();
            $table->integer('adv_part_4')->nullable();
            $table->integer('adv_part_5')->nullable();
            $table->integer('adv_part_6')->nullable();
            $table->integer('adv_part_7')->nullable();
            $table->integer('adv_part_8')->nullable();
            $table->integer('adv_part_9')->nullable();
            $table->integer('adv_part_10')->nullable();
            $table->integer('adv_part_11')->nullable();
            $table->integer('adv_part_12')->nullable();
            $table->integer('adv_part_13')->nullable();
            $table->integer('adv_part_14')->nullable();
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
        Schema::dropIfExists('adv_settings');
    }
}
