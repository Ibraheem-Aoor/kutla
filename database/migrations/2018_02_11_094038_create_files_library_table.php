<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateFilesLibraryTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        
            Schema::create('files_library', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->nullable();
            $table->string('file_name')->nullable();
            $table->enum('type',['photo','file'])->default('photo');
			$table->enum('table_type',['post','writers','albums'])->default('post');
			$table->boolean('is_big')->nullable();
            $table->string('photo_caption')->nullable();
            $table->integer('album_id')->unsigned()->nullable();
			$table->text('tags')->nullable();
            $table->timestamps();
            $table->softDeletes();
            $table->foreign('album_id')->references('id')->on('albums')->onDelete('cascade');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('files_library');
    }
}
