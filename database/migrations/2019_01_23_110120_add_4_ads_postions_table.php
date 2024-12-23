<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Add4AdsPostionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        \DB::statement("ALTER TABLE `advertisements` CHANGE `position` `position` ENUM('header_xlarg','header_large_1','header_large_2','header_medium_1',
'header_medium_2','header_medium_3','header_small_1','header_small_2','header_small_3','header_small_4','main_left','under_main','main_middle_1','main_middle_2','main_middle_3','main_middle_4'
,'main_middle_5','main_middle_6','main_middle_7','main_middle_8','main_middle_9','main_middle_10','internal_big_above','internal_big_middle','internal_big_below','internal_small') CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NULL DEFAULT NULL;");

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
