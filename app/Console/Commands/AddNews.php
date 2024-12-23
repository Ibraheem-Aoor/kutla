<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
class AddNews extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'addnews';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

       DB::table('ramalla_news_old.news')->orderBy('id','ASC')->where('id','>',84289)->chunk(100, function ($all_news) {

            $cat_array=[1=>1,70=>4,71=>15,72=>11,73=>13,75=>18,91=>2,102=>3,107=>26,111=>19
                ,112=>12,114=>21,117=>23,120=>17,121=>22,185=>27,186=>14,188=>20,189=>25,190=>24,192,16];
            $view_type=[0=>1,1=>1,2=>2,3=>3,4=>4,5=>5,6=>6,7=>7,8=>8,9=>9,10=>10,11=>9,12=>11];
        foreach ($all_news as $news){
            $tags=null;
            $tags_ser = @unserialize($news->tags);
            if ($tags_ser !== false) {
                $tags=unserialize($news->tags);
            }

            $array_tages=[];
            if(is_array($tags)){
                for ($x=0;$x<count($tags);$x++){
                    if(isset($tags[$x])){
                        $array_tages[]=$tags[$x]['tag'];
                    }

                }
                if(count($array_tages)){
                    $tag_new=implode(',',$array_tages);
                }

            }
            $detials=DB::table('ramalla_news_old.news_details')->where('news_id',$news->id)->first();

            ////////////////////////////////code add post
            $tag_new=null;
              if(isset($view_type[$news->type])){
                  $show_type=$view_type[$news->type];
              }else{
                  $show_type=1;
              }
            $you_url=null;
            if($detials){
                $you_url=$detials->youtube;
                $youtube_ser = @unserialize($detials->youtube);
                if ($youtube_ser !== false) {
                    $youtube_arr=unserialize($detials->youtube);
                    if(isset($youtube_arr[0]['link'])){
                        $you_url=$youtube_arr[0]['link'];
                    }
                }
            }
            if($you_url=='a:1:{i:0;a:0:{}}'){
                $you_url=null;
            }
            $summary = strip_tags(mb_substr($news->info,0,250, "utf-8"));
            $tag_data=$array_tages;

            $create_at=date('Y-m-d H:i:s', $news->dates);

            $img = new \App\Models\FileLibrary();
            $img->file_name=$news->img;
            $img->type='photo';
            $img->table_type='post';
            $img->created_at=$create_at;
            $img->save();
            if(isset($cat_array[$news->sec_id])){
                $cat_id=$cat_array[$news->sec_id];


            $post = new \App\Models\Post();
            $post->id = $news->id;
            $post->title = $news->title;
            $post->category_id = $cat_id;
            $post->country_id = null;
            $post->writer_id = null;
            $post->details = $detials?$detials->text:null;
            $post->sub_title = $news->caption;
            $post->summary = $summary;
            $post->type='transported';
            if($tag_data){
                $tag_new=implode(',',$tag_data);
                $post->tags = $tag_new;
            }
            $post->source = $detials?$detials->source:'';
            $post->published_at = $create_at;
            $post->created_at = $create_at;
            $post->active = $news->is_hidden==1?0:1;
            $post->photo_id = $img->id;
            $post->case_id =null;
            $post->youtube = $you_url;
            $post->read_number = $news->reads;
            $post->view_type_id = $show_type;
            $post->save();

            if ($array_tages) {
                for($x=0;$x<count($array_tages);$x++) {
                    $old_tag = \App\Models\Tag::where('name', $array_tages[$x])->first();
                    $tag_data[]=$array_tages[$x];
                    if (!$old_tag && $array_tages[$x]) {
                        $old_tag = new \App\Models\Tag();
                        $old_tag->name = $array_tages[$x];
                        $old_tag->save();
                    }
                    $post_tag=new \App\Models\PostTag();
                    $post_tag->post_id=$post->id;
                    $post_tag->tag_id=$old_tag->id;
                    $post_tag->save();
                }

            }
            $array_images=[];
            if($detials){
                $images_ser = @unserialize($detials->images);
                if ($images_ser !== false) {
                    $album_array=unserialize($detials->images);
                    for ($x=0;$x<count($album_array);$x++){
                        if(isset($album_array[$x])){
                            $array_images[]=$album_array[$x]['path'];
                        }

                    }
                }
            }
            if (count($array_images)) {
                for ($x = 0; $x < count($array_images); $x++) {
                    $photo = new \App\Models\PostAlbumPhoto();
                    $photo->photo_id = $array_images[$x];
                    $photo->post_id = $post->id;
                    $photo->save();
                }
            }

            }

        }
        });

    }
}
