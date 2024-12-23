<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddWriterPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->boolean('main2')->default(0);
            $table->boolean('main_news')->default(0);
            $table->boolean('chosen')->default(0);
            $table->string('writer')->nullable();
        });
        Schema::table('main_posts', function (Blueprint $table) {
            $table->boolean('main2')->default(0);
            $table->boolean('main_news')->default(0);
            $table->boolean('chosen')->default(0);
            $table->string('writer')->nullable();
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
