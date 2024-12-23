<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUserLogsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('user_logs', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('logable_id')->nullable();
            $table->string('logable_type')->nullable();
            $table->string('event')->nullable();
            $table->text('record_old')->nullable();
            $table->text('record_new')->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->string('user_ip')->nullable();
            $table->dateTime('time')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('user_logs');
    }
}
