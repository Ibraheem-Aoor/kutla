<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddPostionCategoriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('categories', function (Blueprint $table) {
            $table->integer('position')->unsigned()->nullable();
            $table->boolean('is_menu')->nullable()->default(0);
            $table->foreign('position')->references('id')->on('post_positions')->onDelete('cascade');
        });
        \DB::table('post_positions')->insert([

            ////////////////Type 2
            [
                'id' => 9,
                'name' => 'القسم التاسع'
            ],
            [
                'id' => 10,
                'name' => 'القسم العاشر'
            ],

        ]);
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
