<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostViewTypes extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_view_types', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->timestamps();

        });
        \DB::table('post_view_types')->insert([

            ////////////////Type 2
            [
                'id' => 1,
                'name' => 'خبر'
            ],
            [
                'id' => 2,
                'name' => 'محدث'
            ], [
                'id' => 3,
                'name' => 'تقرير'
            ], [
                'id' => 4,
                'name' => 'تحليل'
            ], [
                'id' => 5,
                'name' => 'بالصور'
            ], [
                'id' => 6,
                'name' => 'بالفيديو'
            ], [
                'id' => 7,
                'name' => 'تحقيق'
            ], [
                'id' => 8,
                'name' => 'بالأسماء'
            ], [
                'id' => 9,
                'name' => 'بالوثائق'
            ], [
                'id' => 10,
                'name' => 'مقال'
            ],
            [
                'id' => 11,
                'name' => 'انفوجرافيك'
            ]

        ]);
        Schema::table('posts', function (Blueprint $table) {
            $table->integer('view_type_id')->unsigned()->default(1)->nullable();
            $table->foreign('view_type_id')->references('id')->on('post_view_types')->onDelete('cascade');
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
