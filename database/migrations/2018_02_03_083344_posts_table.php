<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class PostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned()->nullable();
            $table->integer('writer_id')->unsigned()->nullable();
            $table->string('title')->nullable();
            $table->string('sub_title')->nullable();
            $table->integer('photo_id')->unsigned()->nullable();
            $table->string('photo_caption')->nullable();
            $table->enum('type',['transported','special_report','synthesis_report','special_interview']);
            $table->string('summary')->nullable();
            $table->text('details')->nullable();
            $table->string('youtube')->nullable();
            $table->string('video')->nullable();
            $table->text('tags')->nullable();
            $table->text('photo_album')->nullable();
			$table->text('files')->nullable();
            $table->string('source')->nullable();
            $table->integer('country_id')->unsigned()->nullable();
            $table->dateTime('published_at');
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('writer_id')->references('id')->on('writers')->onDelete('cascade');

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
