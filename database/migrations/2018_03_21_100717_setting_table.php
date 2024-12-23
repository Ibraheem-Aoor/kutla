<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class SettingTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('setting', function (Blueprint $table) {
            $table->increments('id');
            $table->string('web_site_name')->nullable();
            $table->string('email')->nullable();
            $table->string('facebook')->nullable();
            $table->string('youtube')->nullable();
            $table->string('twitter')->nullable();
            $table->string('googepluse')->nullable();
            $table->string('instagram')->nullable();
            $table->string('android')->nullable();
            $table->string('iphone')->nullable();
            $table->string('whatsapp')->nullable();
            $table->string('telegram')->nullable();
            $table->string('nabd')->nullable();
            $table->text('main_tags')->nullable();
            $table->enum('main_post_template',['first','second','third'])->nullable();
            $table->text('phone')->nullable();
            $table->text('mobile')->nullable();
            $table->timestamps();
        });
        \DB::table('setting')->insert([

            ////////////////Type 2
            [
                'id' => 1,
                'web_site_name' => 'بوابتك إلى الحقيقة - فلسطين الآن',
                'email' => 'info@paltimes.ps',
                'facebook' => 'https://www.facebook.com/paltimes.net',
                'youtube' => 'https://www.youtube.com/channel/UCo60trNF6b2FBrJxbfmu3PA',
                'twitter' => 'https://twitter.com/paltimes2015',
                'googepluse' => 'https://plus.google.com/+paltimesnetCH/posts',
                'instagram' => 'https://www.instagram.com/paltimesnet/',
                'android' => 'https://play.google.com/store/apps/details?id=net.paltimes.newsapp&hl=en',
                'nabd' => 'https://nabd.com/paltimes',
                'whatsapp' => 'https://chat.whatsapp.com/invite/FZiackX19qs6umcX4t7QIx',
                'telegram' => 'https://telegram.me/paltimes1',
                'main_tags' => 'فلسطين، فلسطين الآن، فلسطين الان، القدس، غزة، paltimes، رام الله، سوريا، السعودية، مصر، الجزائر، إسرائيل، الضفة، الضفة الغربية، الامارات، لبنان، الأردن، قضايا ساخنة، الشرق الأوسط، منوعات، حارتنا، جريمة، عالم الجريمة، تقارير، أخبار، العالم، صور، فيديو، طرائف، ترفيه',
                'main_post_template' => 'first',
                'phone' => '+97282886017',
                'mobile' => '+972598265310',
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
