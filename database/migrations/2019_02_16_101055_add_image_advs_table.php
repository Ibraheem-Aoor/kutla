<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AddImageAdvsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('advertisements', function (Blueprint $table) {
            $table->string('image1')->nullable();
            $table->string('image2')->nullable();
            $table->string('image3')->nullable();
            $table->string('image4')->nullable();
            $table->string('image_mobile1')->nullable();
            $table->string('image_mobile2')->nullable();
            $table->string('image_mobile3')->nullable();
            $table->string('image_mobile4')->nullable();
            $table->string('iframe1')->nullable();
            $table->string('iframe2')->nullable();
            $table->string('iframe3')->nullable();
            $table->string('iframe4')->nullable();
            $table->dropColumn('image');
            $table->dropColumn('iframe');
            $table->dropColumn('image_mobile');


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
