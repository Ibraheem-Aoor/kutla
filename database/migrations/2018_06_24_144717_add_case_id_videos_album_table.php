<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddCaseIdVideosAlbumTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('videos', function (Blueprint $table) {
            $table->integer('case_id')->unsigned()->nullable();
            $table->foreign('case_id')->references('id')->on('cases')->onDelete('cascade');

        });
        Schema::table('albums', function (Blueprint $table) {
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
        //
    }
}
