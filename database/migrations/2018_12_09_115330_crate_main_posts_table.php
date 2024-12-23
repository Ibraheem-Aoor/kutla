<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CrateMainPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('main_posts', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('category_id')->unsigned()->nullable();
            $table->integer('writer_id')->unsigned()->nullable();
            $table->string('title')->nullable();
            $table->boolean('active')->default(1);
            $table->string('sub_title')->nullable();
            $table->integer('photo_id')->unsigned()->nullable();
            $table->string('photo_caption')->nullable();
            $table->enum('type',['transported','special_report','synthesis_report','special_interview','special_news']);
            $table->string('summary')->nullable();
            $table->text('details')->nullable();
            $table->string('youtube')->nullable();
            $table->string('video')->nullable();
            $table->text('tags')->nullable();
            $table->text('photo_album')->nullable();
            $table->text('files')->nullable();
            $table->string('source')->nullable();
            $table->integer('country_id')->unsigned()->nullable();
            $table->integer('position')->unsigned()->nullable();
            $table->integer('user_id')->unsigned()->nullable();
            $table->integer('case_id')->unsigned()->nullable();
            $table->integer('view_type_id')->unsigned()->nullable();
            $table->integer('read_number')->default(0);
            $table->boolean('main')->default(0);
            $table->string('facebook')->nullable();
            $table->dateTime('published_at');
            $table->integer('post_id')->unsigned()->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade');
            $table->foreign('writer_id')->references('id')->on('writers')->onDelete('cascade');
            $table->foreign('position')->references('id')->on('post_positions')->onDelete('cascade');
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('case_id')->references('id')->on('cases')->onDelete('cascade');
            $table->foreign('view_type_id')->references('id')->on('post_view_types')->onDelete('cascade');
            $table->foreign('post_id')->references('id')->on('posts')->onDelete('cascade');

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
