<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePostPositionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_positions', function (Blueprint $table) {
            $table->increments('id');
			$table->string('name')->nullable();
            $table->timestamps();
        });
		 \DB::table('post_positions')->insert([

            ////////////////Type 2
            [
                'id' => 1,
                'name' => 'القسم الأول'
            ],
			[
                'id' => 2,
                'name' => 'القسم الثاني'
            ],
			[
                'id' => 3,
                'name' => 'القسم الثالث'
            ],
			[
                'id' => 4,
                'name' => 'القسم الرابع'
            ],
			[
                'id' => 5,
                'name' => 'القسم الخامس'
            ],
			[
                'id' => 6,
                'name' => 'القسم السادس'
            ],
			[
                'id' => 7,
                'name' => 'القسم السابع'
            ],
			[
                'id' => 8,
                'name' => 'القسم الثامن'
            ]
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_positions');
    }
}
