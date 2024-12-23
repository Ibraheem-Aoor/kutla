<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateCasesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cases', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->integer('photo_id')->unsigned()->nullable();
            $table->text('details')->nullable();
            $table->timestamps();
            $table->softDeletes();

        });
        Schema::table('posts', function (Blueprint $table) {
            $table->integer('case_id')->unsigned()->nullable();
            $table->foreign('case_id')->references('id')->on('cases')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('cases');
    }
}
