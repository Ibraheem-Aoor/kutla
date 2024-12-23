<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddLiveVideosTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('live_videos', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('file_name')->nullable();
            $table->string('youtube_link')->nullable();
            $table->integer('watchNo')->nullable();
            $table->text('description')->nullable();
            $table->boolean('active')->nullable()->default(0);
            $table->dateTime('start_at')->nullable();
            $table->dateTime('end_at')->nullable();
            $table->integer('photo_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('photo_id')->references('id')->on('files_library')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
