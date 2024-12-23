<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateVoteAnswersResultsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('vote_answers_results', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('vote_id')->unsigned()->nullable();
            $table->integer('vote_answer_id')->unsigned()->nullable();
            $table->string('ip')->nullable();
            $table->timestamps();
            $table->foreign('vote_id')->references('id')->on('votes')->onDelete('cascade');
            $table->foreign('vote_answer_id')->references('id')->on('vote_answers')->onDelete('cascade');

        });
        Schema::table('vote_answers', function (Blueprint $table) {
            $table->integer('answer_count')->default(0);

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('vote_answers_results');
    }
}
