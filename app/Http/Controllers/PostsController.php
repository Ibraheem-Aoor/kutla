<?php

namespace App\Http\Controllers;

use App\Models\AttendanceLog;

use App\Models\Cases;
use App\Models\Category;
use App\Models\Countact;
use App\Models\Country;
use App\Models\MainPost;
use App\Models\Post;
use App\Models\PostAlbumPhoto;
use App\Models\PostPosition;
use App\Models\PostReaction;
use App\Models\ReadMorePost;
use App\Models\Subscription;
use App\Models\Tag;
use App\Models\ViewType;
use App\Models\Writer;
use App\Models\PostTag;
use App\User;
use App\Models\FileLibrary;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;

class PostsController extends Controller
{


    public function index($tag = null)
    {

        meta('title', 'المنشورات');
        if ($tag == null) {
            $breadcrumb = breadcrumbs()
                ->add('المنشورات', '#', 'icon-home')
                ->add(meta('title'));
        } else {
            $breadcrumb = breadcrumbs()
                ->add('المنشورات', route('posts.index'), 'icon-home')
                ->add('الوسوم')
                ->add($tag);
        }

        $categories = Category::where('type', 'post')->get();
        $users = User::get();
        $view_types = ViewType::get();
        meta('breadcrumb', $breadcrumb->render());
        $tag = Tag::where('name', $tag)->first();
        $posts = MainPost::with('Category', 'photo', 'User', 'Position', 'view_type');//->where('remember',0);

        if ($tag) {
            $posts = $posts->where('tags', 'like', '%' . $tag . '%');
        }


        $all_posts = $posts->orderBy('main', 'DESC')->orderBy('main2', 'DESC')->orderBy('order', 'DESC')->take(30);

        $all_posts = $all_posts->get(['id','category_id','writer_id','title','active','type','tags','published_at','created_at','updated_at','position'
        ,'user_id','case_id','view_type_id','read_number','main','main2','main_news','order','slider','private_file','chosen','post_id']);
        $post_ids=$posts->pluck('id')->toArray();
        $post_more=$posts->whereNotIn('id',$post_ids)->count();
        $posts=$all_posts;
   foreach ($posts as $post){
            $post->title=str_replace('&quot;', '', $post->title);
        }
        if (in_array('add_post', $this->actions) || in_array('edit_post', $this->actions) || in_array('delete_post', $this->actions) || in_array('view_post', $this->actions)) {

            return view('dashboards.posts.index', compact('users','tag', 'categories', 'view_types','posts','post_more'));
        } else {
            return view('dashboards.no_permistion');
        }
    }

    public function posts_position()
    {
        meta('title', 'المنشورات المثبتة');

        $breadcrumb = breadcrumbs()
            ->add('المنشورات', route('posts.index'))
            ->add('المنشورات المثبتة', '#', 'icon-home')
            ->add(meta('title'));

        meta('breadcrumb', $breadcrumb->render());


        if (in_array('add_post', $this->actions) || in_array('edit_post', $this->actions) || in_array('delete_post', $this->actions) || in_array('view_post', $this->actions)) {

            return view('dashboards.posts.posts_position');
        } else {
            return view('dashboards.no_permistion');
        }
    }

    public function people_news()
    {
        meta('title', 'أخبار من المتابعين');

        $breadcrumb = breadcrumbs()
            ->add('المنشورات', route('posts.index'))
            ->add('أخبار من المتابعين', '#', 'icon-home')
            ->add(meta('title'));

        meta('breadcrumb', $breadcrumb->render());


        if (in_array('add_post', $this->actions) || in_array('edit_post', $this->actions) || in_array('delete_post', $this->actions) || in_array('view_post', $this->actions)) {

            return view('dashboards.posts.people_news');
        } else {
            return view('dashboards.no_permistion');
        }
    }

    public function create()
    {

        meta('title', 'إضافة منشور');

        $breadcrumb = breadcrumbs()
            ->add('الرئيسية', '#', 'icon-home')
            ->add('المنشورات', route('posts.index'))
            ->add(meta('title'));
        $categories = Category::where('type', 'post')->get();
        $countries = Country::orderBy('en_name', 'ASC')->get();
        $read_more = Post::orderBy('position', 'DESC')->orderBy('order', 'DESC')->take(10)->get(['id','category_id','writer_id','title','active','type','tags','published_at','created_at','updated_at','position'
            ,'user_id','case_id','view_type_id','read_number','main','main_news','slider','order']);


        $writers = Writer::orderBy('name', 'ASC')->get();
        $positions = PostPosition::where('id', '<', 8)->get();
        $cases = Cases::get();
        $view_types = ViewType::get();

        meta('breadcrumb', $breadcrumb->render());
        if (in_array('add_post', $this->actions)) {

            return view('dashboards.posts.form', compact('read_more','view_types', 'categories', 'countries', 'writers', 'positions', 'cases'));
        } else {
            return view('dashboards.no_permistion');
        }

    }

    public function store(Request $request)
    {
        //dd($request->all());

        $this->validate($request, [
            'title' => 'required|max:255',
            'category_id' => 'required',
            'university_id' => 'required',
            // 'country_id'      => 'required',
            'detailes' => 'required',
           // 'view_type_id' => 'required',
           // 'type' => 'required',
//            'summary' => 'required',
            //  'photo_caption'      => 'required',
            // 'tags_post'      => 'required',
            'publish_at' => 'required',
            'active' => 'required',
            'photo_id' => 'required',

        ], [], [
            'title' => 'عنوان المنشور',
            'category_id' => 'التصنيف',
            'university_id' => 'الجامعة',
            // 'country_id'      => 'الدولة',
            'mobile' => 'رقم الموبايل',
            'detailes' => 'التفاصيل',
            'view_type_id' => 'صنف المنشور',
            'type' => 'نوع المنشور',
            'summary' => 'الملخص',
            //'photo_caption'      => 'وصف الصورة',
            // 'tags_post'      => 'الوسوم',
            'publish_at' => 'تاريخ النشر',
            'save' => 'صيغة الحفظ',
            'photo_id' => 'صورة المنشور',

        ]);

       // $publish_at = Carbon::parse($request->published_at)->format('Y-m-d h:i:s');
        //return response()->json($publish_at,404);
        if ($request->main) {
            $array_update = array('main' => 0);
            DB::table('posts')
                ->where('main', 1)
                ->update($array_update);
            DB::table('main_posts')
                ->where('main', 1)
                ->update($array_update);

        }
        if ($request->main2) {
            $array_update = array('main2' => 0);
            DB::table('posts')
                ->where('main2', 1)
                ->update($array_update);
            DB::table('main_posts')
                ->where('main2', 1)
                ->update($array_update);

        }
        $tag_new=null;
        $tag_arr=[];
        $tag_arr=$request->tags_post;
        $tag_data=[];
        if ($request->tags_post) {
            foreach ($tag_arr as $tag) {
                $tag_data[]=$tag['text'];
            }
        }
        $post = new Post();
        $post->title = $request->title;
        $post->category_id = $request->category_id;
        $post->university_id = $request->university_id;
        $post->country_id = $request->country_id;
        $post->writer_id = $request->writer_id;
        $post->details = $request->detailes;
        $post->sub_title = $request->sub_title;
        $post->photo_caption = $request->photo_caption;
        $post->type = $request->type;
        $post->summary = $request->summary;
        $post->youtube = $request->youtube;
        if($tag_data){
            $tag_new=implode(',',$tag_data);
            $post->tags = $tag_new;
        }
        $post->source = $request->source;
        $post->type = $request->type;
        $publish_at = date("Y-m-d H:i:s", strtotime($request->publish_at));

        $post->published_at = $publish_at;
        $post->active = $request->active;
        $post->photo_id = $request->photo_id;
        $post->position = $request->position;
        $post->video = $request->video;
        $post->case_id = $request->case_id;
        $post->youtube = $request->youtube;
        $post->facebook = $request->facebook;
        $post->view_type_id = $request->view_type_id;
        $post->user_id = auth()->user()->id;
        $post->main = $request->main;
        $post->writer = $request->editor;
        $post->main2 = $request->main2;
        $post->main_news = $request->main_news;
        $post->chosen = $request->chosen;
        $post->private_file = $request->private_file;
        $post->slider = $request->slider;
        $post->report = $request->report;
        $post->static = $request->static;
        $post->remember = $request->remember;
        $post->save();
        $post->order=$post->id;
        $post->save();

        $main_post = new MainPost();
        $main_post->title = $request->title;
        $main_post->category_id = $request->category_id;
        $main_post->university_id = $request->university_id;
        $main_post->country_id = $request->country_id;
        $main_post->writer_id = $request->writer_id;
        $main_post->details = $request->detailes;
        $main_post->sub_title = $request->sub_title;
        $main_post->photo_caption = $request->photo_caption;
        $main_post->type = $request->type;
        $main_post->summary = $request->summary;
        $main_post->youtube = $request->youtube;
        if($tag_data){
            $tag_new=implode(',',$tag_data);
            $main_post->tags = $tag_new;
        }
        $main_post->source = $request->source;
        $main_post->type = $request->type;
        $main_post->published_at = $publish_at;
        $main_post->active = $request->active;
        $main_post->photo_id = $request->photo_id;
        $main_post->position = $request->position;
        $main_post->video = $request->video;
        $main_post->case_id = $request->case_id;
        $main_post->youtube = $request->youtube;
        $main_post->facebook = $request->facebook;
        $main_post->view_type_id = $request->view_type_id;
        $main_post->user_id = auth()->user()->id;
        $main_post->main = $request->main;
        $main_post->post_id = $post->id;
        $main_post->writer = $request->editor;
        $main_post->main2 = $request->main2;
        $main_post->main_news = $request->main_news;
        $main_post->chosen = $request->chosen;
        $main_post->private_file = $request->private_file;
        $main_post->slider = $request->slider;
        $main_post->report = $request->report;
        $main_post->static = $request->static;
        $main_post->remember = $request->remember;
        $main_post->order = $post->id;

        $main_post->save();
        $count_main_news=MainPost::where('category_id',$request->category_id)->count();
        if($count_main_news>16){
         $delete_main_news= MainPost::where('category_id',$request->category_id)->orderBy('id','ASC')->first();
            $delete_main_news->delete();
        }
        if ($request->tags_post) {
            foreach ($tag_arr as $tag) {
                $old_tag = Tag::where('name', $tag['text'])->first();
                $tag_data[]=$tag['text'];
                if (!$old_tag && $tag) {
                    $old_tag = new Tag();
                    $old_tag->name = $tag['text'];
                    $old_tag->save();
                }
                $post_tag=new PostTag();
                $post_tag->post_id=$post->id;
                $post_tag->tag_id=$old_tag->id;
                $post_tag->save();
            }

        }
        if ($request->album_image_array) {
            $album_array = json_decode($request->album_image_array);
            for ($x = 0; $x < count($album_array); $x++) {
                $photo = new PostAlbumPhoto();
                $photo->photo_id = $album_array[$x];
                $photo->post_id = $post->id;
                $photo->save();
            }
        }
        if($request->read_more_select){
            $read_more_select=$request->read_more_select;
            for ($x=0;$x<count($read_more_select);$x++){
                $read=new ReadMorePost();
                $read->post_id=$post->id;
                $read->more_post_id=$read_more_select[$x]['id'];
                $read->save();
            }
        }

        $message = 'تمت إضافة المنشور بنجاح';
        $publishDate =  \Carbon\Carbon::parse($post->published_at)->format('Y-m-d');
        $todayDate = Carbon::today()->format('Y-m-d');
        if($request->active != 0 && ($publishDate <=$todayDate )){
            event( new \App\Events\PostPublish($post));
        }

        return response()->json(compact('message','post'));
    }

    public function edit($id)
    {

        meta('title', 'تعديل منشور');
        $post2 = Post::with('Category', 'Country', 'Writer', 'photo', 'PostPhoto.photo', 'Position', 'Video', 'Cases', 'view_type');
		$post1= $post2->find($id)->toJson();
		$post= $post2->find($id);
        $photo_id = PostAlbumPhoto::where('post_id', $id)->pluck('photo_id')->toArray();
        $photo_array = json_encode($photo_id);
        $view_types = ViewType::get();
        $post_edit=Post::select('id')->find($id);

          //  $read_more = Post::orderBy('position', 'DESC')->select('id','title')->orderBy('order', 'DESC')->take(10)->get();

        $breadcrumb = breadcrumbs()
            ->add('الرئيسية', '#', 'icon-home')
            ->add('المنشورات', route('posts.index'))
            ->add(meta('title'));
        $positions = PostPosition::where('id', '<', 8)->get();

        meta('breadcrumb', $breadcrumb->render());

        $categories = Category::where('type', 'post')->get();
        $countries = Country::get();
        $writers = Writer::orderBy('name', 'ASC')->get();
        $html_video = '';
        $cases = Cases::get();

        if ($post && $post->Video && !$post->Video->file_name && $post->Video->youtube_link || $post->youtube) {
           if($post->youtube){

               $yy=$post->youtube;
           }else{
               $yy=$post->Video->youtube_link;
           }
            $link_youtube = explode("v=", $yy);

            $html_video = '<iframe class="embed-responsive-item" width="315" height="200" src="https://www.youtube.com/embed/' . $link_youtube[1] . '?rel=0&#038;showinfo=0" frameborder="0" allowfullscreen></iframe>';

        } elseif ($post && $post->Video && $post->Video->file_name) {
            $html_video = '<video width="315" controls><source src="' . $post->Video->file_name . '" type="video/mp4"></video>';

        }
        if($post->facebook){
            $url=$post->facebook;
            $tmp =explode('/',$url);

            $app_token=getAppToken();
            $curlSession = curl_init();
            curl_setopt($curlSession, CURLOPT_URL, 'https://graph.facebook.com/v2.8/'.$tmp[5].'?fields=description,format,content_category,length&access_token='.$app_token.'&format=json&callback=?');
            curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
            curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);

            $jsonData = json_decode(curl_exec($curlSession));
            $facebook_frame='<div class="article-video-box">
                <div class="embed-responsive embed-responsive-16by9">
                <iframe src="https://www.facebook.com/plugins/video.php?href='.$post->facebook.'&width=560&show_text=false&appId='.env("FACEBOOK_APP_ID").'&height=315"
                width="315" height="200" style="border:none;overflow:hidden" scrolling="no" frameborder="0"
                allowTransparency="true" allowfullscreen="true"  autoplay="false" show-text="false" show-captions="false"></iframe>
                </div>
                </div><br/>';
            $html_video=$facebook_frame;
            curl_close($curlSession);
        }
        if (in_array('edit_post', $this->actions)) {
            return view('dashboards.posts.form', compact('post_edit','post1','view_types', 'html_video', 'cases', 'post', 'categories', 'countries', 'writers', 'photo_array', 'positions'));
        } else {
            return view('dashboards.no_permistion');
        }


    }

    public function search(Request $request)
    {

        $filter = json_decode(request('filter'));
        $tag = $filter->tage_name;
        $cases = $filter->cases;

        $posts = Post::with('Category', 'photo', 'User', 'Position', 'view_type')->where(function ($query) use ($filter) {
            if ($filter->title) {
                $query->where('title', 'like', "%$filter->title%");
            }
            if (isset($filter->start_date) && isset($filter->end_date)) {
                if ($filter->start_date && $filter->end_date) {

                    $published_at = date('Y-m-d H:i:s', strtotime($filter->start_date));
                    $published_to = date('Y-m-d H:i:s', strtotime($filter->end_date));
                    $query->whereBetween('published_at', [$published_at, $published_to]);

                }
            }
            if ($filter->category_id) {
                $query->where('category_id', "$filter->category_id");
            }
            if (isset($filter->view_type_id) && $filter->view_type_id) {
                $query->where('view_type_id', "$filter->view_type_id");
            }
            if ($filter->active_post) {
                $query->where('active', "$filter->active_post");
            }
            if ($filter->user) {
                $query->where('user_id', "$filter->user");
            }

            if ($filter->type == 'slider_1') {
                $query->where('slider', 1);
            }
            if ($filter->type == 'report_1') {
                $query->where('report', 1);
            }
            if ($filter->type == 'news') {
                $query->where('main_news', 1);
            }
            if ($filter->type == 'statment_1') {
                $query->where('chosen', 1);
            }
            if ($filter->type == 'private') {
                $query->where('private_file', 1);
            }
//            if ($filter->type == 'remember') {
//                $query->where('remember', 1);
//            }

        });


//        if (request()->has('filter')) {
//            if ($request->filter != '') {
//                $filter = request('filter');
//                $posts = $posts->where('title', 'LIKE', "%$filter%");
//
//            }
//        }

        if (request()->has('sort') && request()->sort!='{"fieldName":"created_at","order":"desc"}') {
            $sort = json_decode(request('sort'), true);
            $posts = $posts->orderBy((@$sort['fieldName'] ?? 'id'), @$sort['order'] ?? 'desc');
        }
        if ($tag) {


            $posts = $posts->where('tags', 'like', '%' . $tag . '%');
        }
        if ($cases) {
            $posts = $posts->where('case_id', $cases);
        }
        if ($filter->last_id) {
            $posts = $posts->where('id','<',$filter->last_id);
        }
        $result_count=$posts->count();
        $all_posts = $posts->orderBy('position', 'DESC')->orderBy('id', 'desc')->take(15);
        $all_posts = $all_posts->get();
        $post_ids=$posts->pluck('id')->toArray();
        $post_more=$posts->whereNotIn('id',$post_ids)->count();
        $posts=$all_posts;
        return response()->json(compact('posts','post_more','result_count'));
    }

    public function search_postion(Request $request)
    {
        $posts = Post::whereNotNull('position')->with('Category', 'photo', 'User', 'Position', 'view_type')->orderBy('id', 'DESC');

        if (request()->has('filter')) {
            if ($request->filter != '') {
                $filter = request('filter');
                $posts = $posts->where('title', 'LIKE', "%$filter%");

            }
        }

        if (request()->has('sort')) {
            $sort = json_decode(request('sort'), true);
            $posts = $posts->orderBy((@$sort['fieldName'] ?? 'id'), @$sort['order'] ?? 'desc');
        }

        $posts = $posts->paginate(15);

        return response()->json(compact('posts'));
    }

    public function delete_post($id)
    {
        $post = Post::find($id);

        if ($post) {
            $main_post=MainPost::where('post_id',$id)->first();
            if($main_post){
                $main_post->delete();
            }
            $post->delete();
            $message = 'تم الحذف بنجاح';

            return response()->json(compact('message'));
        }

    }

    public function delete_position($id)
    {
        $post = Post::find($id);

        if ($post) {
            $post->position = null;
            $post->save();
            $message = 'تم ازالة الخبر من موضع التثبيت';

            return response()->json(compact('message'));
        }

    }


    public function update(Request $request, $id)
    {
        // return response()->json($request->publish_at,404);
        $this->validate($request, [
            'title' => 'required|max:255',
            'category_id' => 'required',
            //'country_id'      => 'required',
            'detailes' => 'required',
            'university_id' => 'required',
           // 'view_type_id' => 'required',
            //'type' => 'required',
//            'summary' => 'required',
            //'photo_caption'      => 'required',
            //'tags_post'      => 'required',
            'publish_at' => 'required',
            'active' => 'required',
            'photo_id' => 'required',

        ], [], [
            'title' => 'عنوان المنشور',
            'category_id' => 'التصنيف',
            // 'country_id'      => 'الدولة',
             'university_id'      => 'الجامعة',
            'mobile' => 'رقم الموبايل',
            'detailes' => 'التفاصيل',
            'view_type_id' => 'صنف المنشور',
            'type' => 'نوع المنشور',
            'summary' => 'الملخص',
            //'photo_caption'      => 'وصف الصورة',
            //'tags_post'      => 'الوسوم',
            'publish_at' => 'تاريخ النشر',
            'save' => 'صيغة الحفظ',
            'photo_id' => 'صورة المنشور',
        ]);

        // $publish_at = Carbon::parse($request->publish_at)->format('Y-m-d h:i:s');
        if ($request->main) {
            $array_update = array('main' => 0);
            DB::table('posts')
                ->where('main', 1)
                ->update($array_update);
            DB::table('main_posts')
                ->where('main', 1)
                ->update($array_update);

        }
        if ($request->main2) {
            $array_update = array('main2' => 0);
            DB::table('posts')
                ->where('main2', 1)
                ->update($array_update);
            DB::table('main_posts')
                ->where('main2', 1)
                ->update($array_update);

        }

        $post = Post::find($id);
        $publish_at = date("Y-m-d H:i:s", strtotime($request->publish_at));

        if ($post) {
            if($request->active){
                if($post->active==0){
                    $publish_at = date("Y-m-d H:i:s");

                }
            }
            $tag_new = null;
            $tag_arr = $request->tags_post;
            $tag_data = [];
            if ($request->tags_post) {
                PostTag::where('post_id', $id)->delete();
                foreach ($tag_arr as $tag) {
                    if (isset($tag['text'])) {
                        $old_tag = Tag::where('name', $tag['text'])->first();
                        $tag_data[] = $tag['text'];
                        if (!$old_tag && $tag) {
                            $old_tag = new Tag();
                            $old_tag->name = $tag['text'];
                            $old_tag->save();
                        }
                        $post_tag = new PostTag();
                        $post_tag->post_id = $id;
                        $post_tag->tag_id = $old_tag->id;
                        $post_tag->save();
                    }else{
                        $old_tag = Tag::firstOrCreate(['name'=>$tag]);
                        $post_tag = new PostTag();
                        $post_tag->post_id = $id;
                        $post_tag->tag_id = $old_tag->id;
                        $post_tag->save();
                    }
                }
            }

            $post->title = $request->title;
            $post->category_id = $request->category_id;
            $post->university_id = $request->university_id;
            $post->country_id = $request->country_id;
            $post->writer_id = $request->writer_id;
            $post->details = $request->detailes;
            $post->sub_title = $request->sub_title;
            $post->photo_caption = $request->photo_caption;
            $post->type = $request->type;
            $post->summary = $request->summary;
            $post->youtube = $request->youtube;
            $post->private_file = $request->private_file;
            $post->slider = $request->slider;
            $post->static = $request->static;
            $post->remember = $request->remember;

            if ($tag_data) {

                $tag_new = implode(',', $tag_data);

                $post->tags = $tag_new;
            }

            $post->source = $request->source;
            $post->type = $request->type;
            //$publish_at=Carbon::createFromFormat('Y-m-d H:i:s', $request->publish_at);


            $post->published_at = $publish_at;

            $post->active = $request->active;
            $post->photo_id = $request->photo_id;
            $post->position = $request->position;
            $post->video = $request->video;
            $post->case_id = $request->case_id;
            $post->view_type_id = $request->view_type_id;
            $post->main = $request->main;
            $post->youtube = $request->youtube;
            $post->facebook = $request->facebook;
            $post->writer = $request->editor;
            $post->main2 = $request->main2;
            $post->main_news = $request->main_news;
            $post->chosen = $request->chosen;
            $post->report = $request->report;
            $post->save();

            $main_post = MainPost::where('post_id', $id)->first();

            if ($main_post){
                $main_post->title = $request->title;
            $main_post->category_id = $request->category_id;
            $main_post->university_id = $request->university_id;
            $main_post->country_id = $request->country_id;
            $main_post->writer_id = $request->writer_id;
            $main_post->details = $request->detailes;
            $main_post->sub_title = $request->sub_title;
            $main_post->photo_caption = $request->photo_caption;
            $main_post->type = $request->type;
            $main_post->summary = $request->summary;
            $main_post->youtube = $request->youtube;
            if ($tag_data) {
                $tag_new = implode(',', $tag_data);
                $main_post->tags = $tag_new;
            }
            $main_post->source = $request->source;
            $main_post->type = $request->type;
            $main_post->published_at = $publish_at;
            $main_post->active = $request->active;
            $main_post->photo_id = $request->photo_id;
            $main_post->position = $request->position;
            $main_post->video = $request->video;
            $main_post->case_id = $request->case_id;
            $main_post->youtube = $request->youtube;
            $main_post->facebook = $request->facebook;
            $main_post->view_type_id = $request->view_type_id;
            $main_post->user_id = auth()->user()->id;
            $main_post->main = $request->main;
            $main_post->post_id = $post->id;
            $main_post->writer = $request->editor;
            $main_post->main2 = $request->main2;
            $main_post->main_news = $request->main_news;
            $main_post->chosen = $request->chosen;
                $main_post->private_file = $request->private_file;
                $main_post->slider = $request->slider;
                $main_post->report = $request->report;
                $main_post->static = $request->static;
                $main_post->remember = $request->remember;
            $main_post->save();
        }
        }
       

        PostAlbumPhoto::where('post_id', $post->id)->delete();
        if ($request->album_image_array) {
            $album_array = json_decode($request->album_image_array);
            for ($x = 0; $x < count($album_array); $x++) {
                $photo = new PostAlbumPhoto();
                $photo->photo_id = $album_array[$x];
                $photo->post_id = $post->id;
                $photo->save();
            }
        }
        ReadMorePost::where('post_id', $post->id)->delete();
        if($request->read_more_select){
            $read_more_select=$request->read_more_select;
            for ($x=0;$x<count($read_more_select);$x++){
                $read=new ReadMorePost();
                $read->post_id=$post->id;
                $read->more_post_id=$read_more_select[$x]['id'];
                $read->save();
            }
        }


        $message = 'تمت تعديل المنشور بنجاح';

        return response()->json(compact('message','post'));

      //  return response()->json(compact('message'));
    }

    public function post_case($case = null)
    {
        $cases = Cases::find($case);


        meta('title', 'المنشورات');
        if ($case == null) {
            $breadcrumb = breadcrumbs()
                ->add('المنشورات', '#', 'icon-home')
                ->add(meta('title'));
        } else {
            $breadcrumb = breadcrumbs()
                ->add('المنشورات', route('posts.index'), 'icon-home')
                ->add('الملفات الخاصة', route('cases.index'))
                ->add($cases->name);
        }


        meta('breadcrumb', $breadcrumb->render());
        if (in_array('add_post', $this->actions) || in_array('edit_post', $this->actions) || in_array('delete_post', $this->actions) || in_array('view_post', $this->actions)) {
$categories = Category::where('type', 'post')->get();
        $view_types = ViewType::get();

            $posts = Post::with('Category', 'photo', 'User', 'Position', 'view_type');

            if ($cases) {
                $posts = $posts->where('case_id', $case);
            }

            $posts = $posts->orderBy('position', 'DESC')->orderBy('id', 'DESC')->take(30)->get();

            return view('dashboards.posts.index', compact('cases','categories','view_types','posts'));
        } else {
            return view('dashboards.no_permistion');
        }
    }

    public function search_people_news(Request $request)
    {

        $filter = json_decode(request('filter'));
        $posts = Countact::where('type','news')->where(function ($query) use ($filter) {
            if ($filter->title) {
                $query->where('title', 'like', "%$filter->title%");
            }
            if (isset($filter->start_date) && isset($filter->end_date)) {
                if ($filter->start_date && $filter->end_date) {

                    $published_at = date('Y-m-d H:i:s', strtotime($filter->start_date));
                    $published_to = date('Y-m-d H:i:s', strtotime($filter->end_date));
                    $query->whereBetween('created_at', [$published_at, $published_to]);

                }
            }
            if ($filter->user) {
                $query->where('name', "$filter->user");
            }

        });




        if (request()->has('sort') && request()->sort!='{"fieldName":"created_at","order":"desc"}') {
            $sort = json_decode(request('sort'), true);
            $posts = $posts->orderBy(($sort['fieldName'] ?? 'id'), @$sort['order'] ?? 'desc');
        }


        $posts = $posts->orderBy('id', 'DESC')->paginate(25);

        return response()->json(compact('posts'));
    }
	
	    public function get_post($id)
    {
        $read_select=ReadMorePost::where('post_id',$id)->pluck('more_post_id')->toArray();
        $read_more_selected = Post::whereIn('id', $read_select)->orderBy('order', 'DESC')->take(10)->get(['id','category_id','writer_id','title','active','type','tags','published_at','created_at','updated_at','position'
            ,'user_id','case_id','view_type_id','read_number','main','main_news','order','writer',
            'slider']);
                $post = Post::with('Category', 'Country', 'Writer', 'photo', 'PostPhoto.photo', 'Position', 'Video', 'Cases', 'view_type')->find($id);


        return response()->json(compact('post','read_more_selected'));
    }

    public function unpublish_post($id)
    {

        $post = Post::with('Category', 'Country', 'Writer', 'photo', 'PostPhoto.photo', 'Position', 'Video', 'Cases', 'view_type')->find($id);
        if($post){
            $main_post=MainPost::where('post_id',$id)->first();
            if($main_post){
                $main_post->active=0;
                $main_post->save();
            }
            $post->active=0;
            $post->save();

        }

        return response()->json(compact('post'));
    }
    public function publish_post($id)
    {

        $post = Post::with('Category', 'Country', 'Writer', 'photo', 'PostPhoto.photo', 'Position', 'Video', 'Cases', 'view_type')->find($id);
        if($post){
            $main_post=MainPost::where('post_id',$id)->first();
            if($main_post){
                $main_post->active=1;
                $main_post->save();
            }
            $post->active=1;
            $post->save();

        }

        return response()->json(compact('post'));
    }
    public function new_orders(Request $request){
       $orders=$request->new_array_orders;
       for ($x=0;$x<count($orders);$x++){
          $post=Post::find($orders[$x]['id']);
          if($post){
              $post->order=(int)$orders[$x]['order'];
              $post->save();
          }
          $main_post=MainPost::where('post_id',$orders[$x]['id'])->first();
           if($main_post){
               $main_post->order=(int)$orders[$x]['order'];
               $main_post->save();
           }
       }
        $message = 'تمت الترتيب بنجاح';

        return response()->json(compact('message'));
    }

    public function search_post(Request $request)
    {
      $posts = Post::where('title', 'like', "%$request->key%")->orderBy('position', 'DESC')->orderBy('id', 'desc')->take(10)->get();

        return response()->json(compact('posts'));
    }

    public function get_reaction($id)
    {
        $count_like=PostReaction::where('post_id',$id)->where('reaction','like')->count();
        $count_haha=PostReaction::where('post_id',$id)->where('reaction','haha')->count();
        $count_wow=PostReaction::where('post_id',$id)->where('reaction','wow')->count();
        $count_sad=PostReaction::where('post_id',$id)->where('reaction','sad')->count();
        $count_angry=PostReaction::where('post_id',$id)->where('reaction','angry')->count();
        return response()->json(compact('count_like','count_haha','count_wow','count_sad','count_angry'));
    }





}