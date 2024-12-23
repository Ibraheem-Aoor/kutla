<?php

namespace App\Http\Controllers;


use App\Models\Adv;
use App\Models\AdvSetting;
use App\Models\Albom;
use App\Models\Cases;
use App\Models\Category;
use App\Models\Countact;
use App\Models\FileLibrary;
use App\Models\Home;
use App\Models\Hotel;
use App\Models\LiveVideo;
use App\Models\MailList;
use App\Models\MainPost;
use App\Models\Page;
use App\Models\Post;
use App\Models\PostReaction;
use App\Models\PostRead;
use App\Models\PostTag;
use App\Models\ReadMorePost;
use App\Models\Setting;
use App\Models\Tag;
use App\Models\Urgent;
use App\Models\Video;
use App\Models\Visitor;
use App\Models\Vote;
use App\Models\VoteAnswer;
use App\Models\VoteAnswerResult;
use Carbon\Carbon;
use Illuminate\Http\Request;
use DB;

class HomeController extends Controller
{
    protected $setting;
//    protected $last_news_main;
   protected $categories;

    public function __construct()
    {

        $setting=Setting::first();
        $this->setting=$setting;
        $this->can_vote=true;
        $this->answer_count=0;
        $this->adv_setting=AdvSetting::get();

        $this->vote=Vote::with('answers')->where('active',1)->orderBy('id','DESC')->first();
        $visitor_data=ip_info();
       // $visitor_new=ip_data("Visitor", "Location");
        $visitor_new=['ip'=>ip_info(),'country'=>'adasdasd'];
//        if($visitor_new && $visitor_new['ip']){
//
//            $visitor=Visitor::where('ip',$visitor_new['ip'])->first();
//
//            if(!$visitor){
//                $visitor=new Visitor();
//                $visitor->ip=$visitor_new['ip'];
//                $visitor->city=$visitor_new['city'];
//                $visitor->country=$visitor_new['country'];
//                $visitor->save();
//            }
//        }
        if($this->vote){
            if($this->vote->start_date <= date('Y-m-d') && $this->vote->end_date >= date('Y-m-d')){
                $this->can_vote=true;

            }else{
                $this->can_vote=false;
            }
            $anser_ip=VoteAnswerResult::where('ip',$visitor_data)->where('vote_id',$this->vote->id)->first();


            $this->answer_count=VoteAnswer::where('vote_id',$this->vote->id)->sum('answer_count');

            if($anser_ip){
                $this->can_vote=false;
            }
        }

        $this->categories=Category::where('is_menu',1)->orderBy('order','ASC')->take(6)->get();

        if($visitor_new['country']=="Palestine" || $visitor_new['country']=="Israel"){
            $this->adv_part_1=Adv::where('page','main')->where('position',1)->where('location','ps')->orderBy('id','DESC')->first();
            if(!$this->adv_part_1){
                $this->adv_part_1=Adv::where('page','main')->where('position',1)->orderBy('id','DESC')->first();

            }
        }else{
            $this->adv_part_1=Adv::where('page','main')->where('position',1)->where(function ($ss){
                $ss->where('location','other')->orWhere('location','all');
            })->orderBy('id','DESC')->first();
        }


        view()->share('setting', $this->setting);

        view()->share('categories', $this->categories);
        view()->share('vote', $this->vote);
        view()->share('can_vote', $this->can_vote);
        view()->share('answer_count', $this->answer_count);
        view()->share('adv_setting', $this->adv_setting);
        view()->share('adv_part_1', $this->adv_part_1);
        $this->wether=check_wheather();
        view()->share('wether', $this->wether);


    }

    public function index()
    {

        $post_id_array=[];
        $date_now=date('Y-m-d H:i:s');

        $post_position_1=MainPost::with('Category','photo','Video','view_type')->where('active',1)->where('published_at','<',$date_now)->where('main',1)->orderBy('order','DESC')->first();
        if(!$post_position_1){
            $post_position_1=MainPost::with('Category','photo','Video','view_type')->where('active',1)->whereNull('position')->where('published_at','<',$date_now)->where('main2',0)->orderBy('order','DESC')->first();
        }
        $post_id_array[]=$post_position_1->id;

        //////////// postion 2
        $post_position_2=MainPost::with('Category','photo','Video','view_type')->where('active',1)->where('published_at','<',$date_now)->where('main2',1)->orderBy('order','DESC')->first();
        if(!$post_position_2 && $post_position_1){

            $post_position_2=MainPost::with('Category','photo','Video','view_type')->where('active',1)->whereNull('position')->whereNotIn('id',$post_id_array)->where('published_at','<',$date_now)->orderBy('order','DESC')->first();

        }
        $post_id_array[]=$post_position_2->id;
        $last_news_main= MainPost::with('Category','photo','view_type')->where('main_news',1)->whereNotIn('id',$post_id_array)->where('active',1)->where('published_at','<',$date_now)->orderBy('order','DESC')->take(9);
        $last_news_id=$last_news_main->pluck('id')->toArray();
//        $post_id_array=array_merge($post_id_array,$last_news_id);
        $post_id_array2=array_merge($post_id_array,$last_news_id);
        $last_news_main=$last_news_main->get();
        $last_news_main2= MainPost::with('Category','photo','view_type')->whereNotIn('id',$post_id_array2)->where('active',1)->where('published_at','<',$date_now)->orderBy('order','DESC')->where('main_news',1)->take(9)->get();

        $chosen = MainPost::with('Category', 'photo', 'view_type')->whereNotIn('id',$post_id_array)->where('chosen',1)->where('active', 1)->where('published_at', '<', $date_now)->orderBy('order', 'DESC')->take(8)->get();
        /////////////////////////////////
        $category_position_1=Category::where('position',1)->first();

        if($category_position_1) {
            $posts_category_1 = MainPost::with('Category', 'photo', 'view_type')->whereNotIn('id',$post_id_array)->where('category_id',$category_position_1->id)->where('active', 1)->where('published_at', '<', $date_now)->orderBy('order', 'DESC')->take(5)->get();
        }
        $category_position_2=Category::where('position',2)->first();
        if($category_position_2) {
            $posts_category_2 = MainPost::with('Category', 'photo', 'view_type')->whereNotIn('id',$post_id_array)->where('category_id',$category_position_2->id)->where('active', 1)->where('published_at', '<', $date_now)->orderBy('order', 'DESC')->take(5)->get();
        }
        $category_position_3=Category::where('position',3)->first();
        if($category_position_3) {
            $posts_category_3 = MainPost::with('Category', 'photo', 'view_type')->whereNotIn('id',$post_id_array)->where('category_id',$category_position_3->id)->where('active', 1)->where('published_at', '<', $date_now)->orderBy('order', 'DESC')->take(5)->get();
        }
        /****/
        $category_position_4=Category::where('position',4)->first();
        if($category_position_4) {
            $posts_category_4 = MainPost::with('Category', 'photo', 'view_type')->whereNotIn('id',$post_id_array)->where('category_id',$category_position_4->id)->where('active', 1)->where('published_at', '<', $date_now)->orderBy('order', 'DESC')->take(5)->get();
        }
        $category_position_5=Category::where('position',5)->first();
        if($category_position_5) {
            $posts_category_5 = MainPost::with('Category', 'photo', 'view_type')->whereNotIn('id',$post_id_array)->where('category_id',$category_position_5->id)->where('active', 1)->where('published_at', '<', $date_now)->orderBy('order', 'DESC')->take(4)->get();
        }
        $category_position_6=Category::where('position',6)->first();
        if($category_position_6) {
            $posts_category_6 = MainPost::with('Category', 'photo', 'view_type')->whereNotIn('id',$post_id_array)->where('category_id',$category_position_6->id)->where('active', 1)->where('published_at', '<', $date_now)->orderBy('order', 'DESC')->take(4)->get();
        }
        $category_position_7=Category::where('position',7)->first();

        if($category_position_7) {
            $posts_category_7 = MainPost::with('Category', 'photo', 'view_type')->whereNotIn('id',$post_id_array)->where('category_id',$category_position_7->id)->where('active', 1)->where('published_at', '<', $date_now)->orderBy('order', 'DESC')->take(4)->get();
        }
        $category_position_8=Category::where('position',8)->first();
        if($category_position_8) {
            $posts_category_8 = MainPost::with('Category', 'photo', 'view_type')->whereNotIn('id',$post_id_array)->where('category_id',$category_position_8->id)->where('active', 1)->where('published_at', '<', $date_now)->orderBy('order', 'DESC')->take(4)->get();
        }
        $date_today=date('Y-m-d H:i:s');
        $date_last=date('Y-m-d H:i:s', strtotime('-7 days'));
        $most_read_week=PostRead::select(DB::raw("count('post_id') as repetition, post_id"))
            ->whereBetween('created_at',[$date_last,$date_today])
            ->groupBy('post_id')
            ->orderBy('repetition', 'desc')
            ->take(3)->with('main_post')->get();
        $albums=Albom::where('active',1)->with('photoscover')->orderBy('id','DESC')->take(4)->get();
        $videos=Video::where('active',1)->with('photo')->orderBy('id','DESC')->take(8)->get();
        $visitor_new=['ip'=>ip_info(),'country'=>'adasdasd'];

        if($visitor_new['country']=="Palestine" || $visitor_new['country']=="Israel"){
            $adv_part_2=Adv::where('page','main')->where('position',2)->where('location','ps')->orderBy('id','DESC')->first();
            if(!$adv_part_2){
                $adv_part_2=Adv::where('page','main')->where('position',2)->orderBy('id','DESC')->first();

            }
        }else{
            $adv_part_2=Adv::where('page','main')->where('position',2)->where(function ($ss){
                $ss->where('location','other')->orWhere('location','all');
            })->orderBy('id','DESC')->first();
        }
        ///////
        if($visitor_new['country']=="Palestine" || $visitor_new['country']=="Israel"){
            $adv_part_3=Adv::where('page','main')->where('position',3)->where('location','ps')->orderBy('id','DESC')->first();
            if(!$adv_part_3){
                $adv_part_3=Adv::where('page','main')->where('position',3)->orderBy('id','DESC')->first();

            }
        }else{
            $adv_part_3=Adv::where('page','main')->where('position',3)->where(function ($ss){
                $ss->where('location','other')->orWhere('location','all');
            })->orderBy('id','DESC')->first();
        }
        /////////
        if($visitor_new['country']=="Palestine" || $visitor_new['country']=="Israel"){
            $adv_part_4=Adv::where('page','main')->where('position',4)->where('location','ps')->orderBy('id','DESC')->first();
            if(!$adv_part_4){
                $adv_part_4=Adv::where('page','main')->where('position',4)->orderBy('id','DESC')->first();

            }
        }else{
            $adv_part_4=Adv::where('page','main')->where('position',4)->where(function ($ss){
                $ss->where('location','other')->orWhere('location','all');
            })->orderBy('id','DESC')->first();
        }
        //////////////////
        if($visitor_new['country']=="Palestine" || $visitor_new['country']=="Israel"){
            $adv_part_5=Adv::where('page','main')->where('position',5)->where('location','ps')->orderBy('id','DESC')->first();
            if(!$adv_part_5){
                $adv_part_5=Adv::where('page','main')->where('position',5)->orderBy('id','DESC')->first();

            }
        }else{
            $adv_part_5=Adv::where('page','main')->where('position',5)->where(function ($ss){
                $ss->where('location','other')->orWhere('location','all');
            })->orderBy('id','DESC')->first();
        }
        /////////////////
        if($visitor_new['country']=="Palestine" || $visitor_new['country']=="Israel"){
            $adv_part_6=Adv::where('page','main')->where('position',6)->where('location','ps')->orderBy('id','DESC')->first();
            if(!$adv_part_6){
                $adv_part_6=Adv::where('page','main')->where('position',6)->orderBy('id','DESC')->first();

            }
        }else{
            $adv_part_6=Adv::where('page','main')->where('position',6)->where(function ($ss){
                $ss->where('location','other')->orWhere('location','all');
            })->orderBy('id','DESC')->first();
        }
        /////////////////
        if($visitor_new['country']=="Palestine" || $visitor_new['country']=="Israel"){
            $adv_part_7=Adv::where('page','main')->where('position',7)->where('location','ps')->orderBy('id','DESC')->first();
            if(!$adv_part_7){
                $adv_part_7=Adv::where('page','main')->where('position',7)->orderBy('id','DESC')->first();

            }
        }else{
            $adv_part_7=Adv::where('page','main')->where('position',7)->where(function ($ss){
                $ss->where('location','other')->orWhere('location','all');
            })->orderBy('id','DESC')->first();
        }
        //////////
        if($visitor_new['country']=="Palestine" || $visitor_new['country']=="Israel"){
            $adv_part_8=Adv::where('page','main')->where('position',8)->where('location','ps')->orderBy('id','DESC')->first();
            if(!$adv_part_8){
                $adv_part_8=Adv::where('page','main')->where('position',8)->orderBy('id','DESC')->first();

            }
        }else{
            $adv_part_8=Adv::where('page','main')->where('position',8)->where(function ($ss){
                $ss->where('location','other')->orWhere('location','all');
            })->orderBy('id','DESC')->first();
        }
        /////////////////
        if($visitor_new['country']=="Palestine" || $visitor_new['country']=="Israel"){
            $adv_part_9=Adv::where('page','main')->where('position',9)->where('location','ps')->orderBy('id','DESC')->first();
            if(!$adv_part_9){
                $adv_part_9=Adv::where('page','main')->where('position',9)->orderBy('id','DESC')->first();

            }
        }else{
            $adv_part_9=Adv::where('page','main')->where('position',9)->where(function ($ss){
                $ss->where('location','other')->orWhere('location','all');
            })->orderBy('id','DESC')->first();
        }
        /////////
        if($visitor_new['country']=="Palestine" || $visitor_new['country']=="Israel"){
            $adv_part_10=Adv::where('page','main')->where('position',10)->where('location','ps')->orderBy('id','DESC')->first();
            if(!$adv_part_10){
                $adv_part_10=Adv::where('page','main')->where('position',10)->orderBy('id','DESC')->first();

            }
        }else{
            $adv_part_10=Adv::where('page','main')->where('position',10)->where(function ($ss){
                $ss->where('location','other')->orWhere('location','all');
            })->orderBy('id','DESC')->first();
        }
        ////////////
        if($visitor_new['country']=="Palestine" || $visitor_new['country']=="Israel"){
            $adv_part_11=Adv::where('page','main')->where('position',11)->where('location','ps')->orderBy('id','DESC')->first();
            if(!$adv_part_11){
                $adv_part_11=Adv::where('page','main')->where('position',11)->orderBy('id','DESC')->first();

            }
        }else{
            $adv_part_11=Adv::where('page','main')->where('position',11)->where(function ($ss){
                $ss->where('location','other')->orWhere('location','all');
            })->orderBy('id','DESC')->first();
        }
        //////////////////
        if($visitor_new['country']=="Palestine" || $visitor_new['country']=="Israel"){
            $adv_part_12=Adv::where('page','main')->where('position',12)->where('location','ps')->orderBy('id','DESC')->first();
            if(!$adv_part_12){
                $adv_part_12=Adv::where('page','main')->where('position',12)->orderBy('id','DESC')->first();

            }
        }else{
            $adv_part_12=Adv::where('page','main')->where('position',12)->where(function ($ss){
                $ss->where('location','other')->orWhere('location','all');
            })->orderBy('id','DESC')->first();
        }
        /////////
        if($visitor_new['country']=="Palestine" || $visitor_new['country']=="Israel"){
            $adv_part_13=Adv::where('page','main')->where('position',13)->where('location','ps')->orderBy('id','DESC')->first();
            if(!$adv_part_13){
                $adv_part_13=Adv::where('page','main')->where('position',13)->orderBy('id','DESC')->first();

            }
        }else{
            $adv_part_13=Adv::where('page','main')->where('position',13)->where(function ($ss){
                $ss->where('location','other')->orWhere('location','all');
            })->orderBy('id','DESC')->first();
        }
        ////////////////
        if($visitor_new['country']=="Palestine" || $visitor_new['country']=="Israel"){
            $adv_part_14=Adv::where('page','main')->where('position',14)->where('location','ps')->orderBy('id','DESC')->first();
            if(!$adv_part_14){
                $adv_part_14=Adv::where('page','main')->where('position',14)->orderBy('id','DESC')->first();

            }
        }else{
            $adv_part_14=Adv::where('page','main')->where('position',14)->where(function ($ss){
                $ss->where('location','other')->orWhere('location','all');
            })->orderBy('id','DESC')->first();
        }

        $time_aladan=get_adhan();

        $check_rate=check_rate();
        $USD_ILS=$check_rate->usd;
        $JOD_ILS=$check_rate->jod;
        $ILS_EGP=$check_rate->egp;
        $EUR_ILS=$check_rate->eur;
        return view('home.index',compact('post_position_1','post_position_2','last_news_main','category_position_1','category_position_2','category_position_3'
            ,'category_position_4','category_position_5','category_position_6','category_position_7','category_position_8','most_read_week'
        ,'posts_category_1','posts_category_2','posts_category_3','posts_category_4','posts_category_5','posts_category_6','posts_category_7','posts_category_8','chosen'
        ,'albums','videos','time_aladan','adv_part_2','adv_part_3','adv_part_4','adv_part_5','adv_part_6','adv_part_7','adv_part_8','adv_part_9'
            ,'adv_part_10','adv_part_11','adv_part_12','adv_part_13','adv_part_14','USD_ILS','JOD_ILS','ILS_EGP','EUR_ILS','last_news_main2'));
    }

    public function getVideoMedia($id){

        $video=Video::find($id);
        if($video){
            $video->watchNo=$video->watchNo+1;
            $video->save();
            if($video->file_name){

                $html= '<video width="1080" height="650" controls autoplay><source src="'.asset($video->file_name).'" type="video/mp4" ></video>';
            }elseif($video->youtube_link){
                if( strpos($video->youtube_link, 'embed/') !== false) {
                    $you_link = explode('embed/', $video->youtube_link);
                }else{
                    $you_link = explode('v=', $video->youtube_link);
                }

                $html='<iframe class="embed-responsive-item" width="1080" height="650" src="https://www.youtube.com/embed/'.$you_link[1].'?autoplay=1&rel=0&#038;showinfo=0" frameborder="0" allowfullscreen></iframe>';

            }

        }else{
            $html='<div style="background-color: white !important;"> لا يمكن العثور على المطلوب</div>';
        }
        return response()->json($html);
    }

    public function add_to_mail(Request $request)
    {
        $this->validate($request, [
            'email'      => 'required|email'
        ], [], [
            'email'      => 'البريد الإلكتروني'
        ]);


        $old_mail=MailList::where('email',$request->email)->count();

        if($old_mail>0){
            $message = 'ايميلك مضاف مسبقا للقائمة البريدية';

            return response()->json(compact('message'),404);
        }
        $mail=new MailList();
        $mail->email=$request->email;
        $mail->email_ip=getUserIP();
        $mail->save();



        $message = 'تمت اضافتك للقائمة البريدية بنجاح';

        return response()->json(compact('message'));
    }
    public function answer_vote(Request $request)
    {

        $visitor_data=ip_info();

        $mail=new VoteAnswerResult();
        $mail->vote_id=$request->vote_id;
        $mail->vote_answer_id=$request->vot_answer;
        $mail->ip=$visitor_data;
        $mail->save();
        $vote_answer=VoteAnswer::where('id',$request->vot_answer)->first();
        if($vote_answer){
            $vote_answer->answer_count=$vote_answer->answer_count+1;
            $vote_answer->save();
        }
        $message = 'تم التصويت';

        return response()->json(compact('message'));
    }

    public function post_details($id,$title =null)
    {
        $date_now=date('Y-m-d H:i:s');


        $post_details=Post::with('Category','photo','Video','PostPhoto','view_type')->where('id',$id)->first();
        $previous_post = Post::with('Category','photo','Video','PostPhoto','view_type')->where('id', '<', $id)->orderBy('id','DESC')->first();

        // get next user id
        $next_post = Post::with('Category','photo','Video','PostPhoto','view_type')->where('id', '>', $id)->orderBy('id','DESC')->first();

        if($post_details){
            $post_details->read_number=$post_details->read_number+1;
            $post_details->save();
            $main_post=MainPost::where('post_id',$post_details->id)->first();
            if($main_post){
                $main_post->read_number=$main_post->read_number+1;
                $main_post->save();
            }

            if($post_details->tags){
                //  $tags=implode(',',$post_details->tags);

            }
            $visitor_new=['ip'=>ip_info(),'country'=>'adasdasd'];
            if($visitor_new['country']=="Palestine" || $visitor_new['country']=="Israel"){
                $adv_part_1_1=Adv::where('page','details')->where('position',1)->where('location','ps')->orderBy('id','DESC')->first();
                if(!$adv_part_1_1){
                    $adv_part_1_1=Adv::where('page','details')->where('position',1)->orderBy('id','DESC')->first();

                }
            }else{
                $adv_part_1_1=Adv::where('page','details')->where('position',1)->where(function ($ss){
                    $ss->where('location','other')->orWhere('location','all');
                })->orderBy('id','DESC')->first();
            }
            if($visitor_new['country']=="Palestine" || $visitor_new['country']=="Israel"){
                $adv_part_2=Adv::where('page','details')->where('position',2)->where('location','ps')->orderBy('id','DESC')->first();
                if(!$adv_part_2){
                    $adv_part_2=Adv::where('page','details')->where('position',2)->orderBy('id','DESC')->first();

                }
            }else{
                $adv_part_2=Adv::where('page','details')->where('position',2)->where(function ($ss){
                    $ss->where('location','other')->orWhere('location','all');
                })->orderBy('id','DESC')->first();
            }
            ///////
            if($visitor_new['country']=="Palestine" || $visitor_new['country']=="Israel"){
                $adv_part_3=Adv::where('page','details')->where('position',3)->where('location','ps')->orderBy('id','DESC')->first();
                if(!$adv_part_3){
                    $adv_part_3=Adv::where('page','details')->where('position',3)->orderBy('id','DESC')->first();

                }
            }else{
                $adv_part_3=Adv::where('page','details')->where('position',3)->where(function ($ss){
                    $ss->where('location','other')->orWhere('location','all');
                })->orderBy('id','DESC')->first();
            }
            /////////
            if($visitor_new['country']=="Palestine" || $visitor_new['country']=="Israel"){
                $adv_part_4=Adv::where('page','details')->where('position',4)->where('location','ps')->orderBy('id','DESC')->first();
                if(!$adv_part_4){
                    $adv_part_4=Adv::where('page','details')->where('position',4)->orderBy('id','DESC')->first();

                }
            }else{
                $adv_part_4=Adv::where('page','details')->where('position',4)->where(function ($ss){
                    $ss->where('location','other')->orWhere('location','all');
                })->orderBy('id','DESC')->first();
            }
            //////////////////
            if($visitor_new['country']=="Palestine" || $visitor_new['country']=="Israel"){
                $adv_part_5=Adv::where('page','details')->where('position',5)->where('location','ps')->orderBy('id','DESC')->first();
                if(!$adv_part_5){
                    $adv_part_5=Adv::where('page','details')->where('position',5)->orderBy('id','DESC')->first();

                }
            }else{
                $adv_part_5=Adv::where('page','details')->where('position',5)->where(function ($ss){
                    $ss->where('location','other')->orWhere('location','all');
                })->orderBy('id','DESC')->first();
            }
            /////////////////
            if($visitor_new['country']=="Palestine" || $visitor_new['country']=="Israel"){
                $adv_part_6=Adv::where('page','details')->where('position',6)->where('location','ps')->orderBy('id','DESC')->first();
                if(!$adv_part_6){
                    $adv_part_6=Adv::where('page','details')->where('position',6)->orderBy('id','DESC')->first();

                }
            }else{
                $adv_part_6=Adv::where('page','details')->where('position',6)->where(function ($ss){
                    $ss->where('location','other')->orWhere('location','all');
                })->orderBy('id','DESC')->first();
            }
            /////////////////
            if($visitor_new['country']=="Palestine" || $visitor_new['country']=="Israel"){
                $adv_part_7=Adv::where('page','details')->where('position',7)->where('location','ps')->orderBy('id','DESC')->first();
                if(!$adv_part_7){
                    $adv_part_7=Adv::where('page','details')->where('position',7)->orderBy('id','DESC')->first();

                }
            }else{
                $adv_part_7=Adv::where('page','details')->where('position',7)->where(function ($ss){
                    $ss->where('location','other')->orWhere('location','all');
                })->orderBy('id','DESC')->first();
            }
            //////////
            if($visitor_new['country']=="Palestine" || $visitor_new['country']=="Israel"){
                $adv_part_8=Adv::where('page','details')->where('position',8)->where('location','ps')->orderBy('id','DESC')->first();
                if(!$adv_part_8){
                    $adv_part_8=Adv::where('page','details')->where('position',8)->orderBy('id','DESC')->first();

                }
            }else{
                $adv_part_8=Adv::where('page','details')->where('position',8)->where(function ($ss){
                    $ss->where('location','other')->orWhere('location','all');
                })->orderBy('id','DESC')->first();
            }
            /////////////////

            $last_add = Post::with('Category','photo','view_type')->where('active',1)->where('published_at','<',$date_now)->orderBy('published_at','DESC')->take(9)->get();

              $relatedPosts_cat = Post::with('Category','photo','view_type')->where('active',1)->where('category_id',$post_details->category_id)->where('id','<>',$post_details->id)->where('published_at','<',$date_now)->orderBy('published_at','DESC')->take(3);
            $relatedPosts_cat_arr=$relatedPosts_cat->pluck('id')->toArray();
            $relatedPosts_cat = $relatedPosts_cat->get();

            $news_details=$post_details->details;
            $post_tags=PostTag::where('post_id',$id)->get();

            $news_details=str_replace('<label style="display: none;">XX</label>',"<i style='color:font-size: 20px;color: #55acee;' class='fa fa-twitter'></i>",$news_details);
            $news_details=str_replace('HUSAMNNNNNNN'," ".url('post/'.$post_details->id.'/'.(implode('-',explode(' ',$post_details->title)))),$news_details);

            if($post_details->view_type_id_new!=1){
                $post_title=$post_details->view_type->name.': '.$post_details->title;
            }else{
                $post_title=$post_details->title;

            }
            meta('title', $post_title);

            $useragent=$_SERVER['HTTP_USER_AGENT'];
            $device='computer';
            if(preg_match('/(android|bb\d+|meego).+mobile|avantgo|bada\/|blackberry|blazer|compal|elaine|fennec|hiptop|iemobile|ip(hone|od)|iris|kindle|lge |maemo|midp|mmp|netfront|opera m(ob|in)i|palm( os)?|phone|p(ixi|re)\/|plucker|pocket|psp|series(4|6)0|symbian|treo|up\.(browser|link)|vodafone|wap|windows (ce|phone)|xda|xiino/i',$useragent)||preg_match('/1207|6310|6590|3gso|4thp|50[1-6]i|770s|802s|a wa|abac|ac(er|oo|s\-)|ai(ko|rn)|al(av|ca|co)|amoi|an(ex|ny|yw)|aptu|ar(ch|go)|as(te|us)|attw|au(di|\-m|r |s )|avan|be(ck|ll|nq)|bi(lb|rd)|bl(ac|az)|br(e|v)w|bumb|bw\-(n|u)|c55\/|capi|ccwa|cdm\-|cell|chtm|cldc|cmd\-|co(mp|nd)|craw|da(it|ll|ng)|dbte|dc\-s|devi|dica|dmob|do(c|p)o|ds(12|\-d)|el(49|ai)|em(l2|ul)|er(ic|k0)|esl8|ez([4-7]0|os|wa|ze)|fetc|fly(\-|_)|g1 u|g560|gene|gf\-5|g\-mo|go(\.w|od)|gr(ad|un)|haie|hcit|hd\-(m|p|t)|hei\-|hi(pt|ta)|hp( i|ip)|hs\-c|ht(c(\-| |_|a|g|p|s|t)|tp)|hu(aw|tc)|i\-(20|go|ma)|i230|iac( |\-|\/)|ibro|idea|ig01|ikom|im1k|inno|ipaq|iris|ja(t|v)a|jbro|jemu|jigs|kddi|keji|kgt( |\/)|klon|kpt |kwc\-|kyo(c|k)|le(no|xi)|lg( g|\/(k|l|u)|50|54|\-[a-w])|libw|lynx|m1\-w|m3ga|m50\/|ma(te|ui|xo)|mc(01|21|ca)|m\-cr|me(rc|ri)|mi(o8|oa|ts)|mmef|mo(01|02|bi|de|do|t(\-| |o|v)|zz)|mt(50|p1|v )|mwbp|mywa|n10[0-2]|n20[2-3]|n30(0|2)|n50(0|2|5)|n7(0(0|1)|10)|ne((c|m)\-|on|tf|wf|wg|wt)|nok(6|i)|nzph|o2im|op(ti|wv)|oran|owg1|p800|pan(a|d|t)|pdxg|pg(13|\-([1-8]|c))|phil|pire|pl(ay|uc)|pn\-2|po(ck|rt|se)|prox|psio|pt\-g|qa\-a|qc(07|12|21|32|60|\-[2-7]|i\-)|qtek|r380|r600|raks|rim9|ro(ve|zo)|s55\/|sa(ge|ma|mm|ms|ny|va)|sc(01|h\-|oo|p\-)|sdk\/|se(c(\-|0|1)|47|mc|nd|ri)|sgh\-|shar|sie(\-|m)|sk\-0|sl(45|id)|sm(al|ar|b3|it|t5)|so(ft|ny)|sp(01|h\-|v\-|v )|sy(01|mb)|t2(18|50)|t6(00|10|18)|ta(gt|lk)|tcl\-|tdg\-|tel(i|m)|tim\-|t\-mo|to(pl|sh)|ts(70|m\-|m3|m5)|tx\-9|up(\.b|g1|si)|utst|v400|v750|veri|vi(rg|te)|vk(40|5[0-3]|\-v)|vm40|voda|vulc|vx(52|53|60|61|70|80|81|83|85|98)|w3c(\-| )|webc|whit|wi(g |nc|nw)|wmlb|wonu|x700|yas\-|your|zeto|zte\-/i',substr($useragent,0,4)))
            {
                $device='mobile';
            }

            $html_face='';
            if($post_details->facebook){
                $url=$post_details->facebook;
                $tmp =explode('/',$url);

                $app_token=getAppToken();
                $curlSession = curl_init();
                curl_setopt($curlSession, CURLOPT_URL, 'https://graph.facebook.com/v2.8/'.$tmp[5].'?fields=description,format,content_category,length&access_token='.$app_token.'&format=json&callback=?');
                curl_setopt($curlSession, CURLOPT_BINARYTRANSFER, true);
                curl_setopt($curlSession, CURLOPT_RETURNTRANSFER, true);

                $jsonData = json_decode(curl_exec($curlSession));
                $html_face='
                <iframe src="https://www.facebook.com/plugins/video.php?href='.$post_details->facebook.'&width=560&show_text=false&appId='.env("FACEBOOK_APP_ID").'&height=315"
                width="770" height="460" style="border:none;overflow:hidden" scrolling="no" frameborder="0"
                allowTransparency="true" allowfullscreen="true"  autoplay="false" show-text="false" show-captions="false"></iframe>
                ';
                curl_close($curlSession);
            }
            //////////////////////////////////////////////////////////
            $relatedPostsList=array();
            $tag_ids=array();
            $relatedPostsCount=0;
            $relatedPosts=array();
            $relatedPostRest=array();
            $tag_ids=[];
            if($post_details->tags){
                $tag_ids = explode(',',$post_details->tags);
            }

            if(!empty($tag_ids)){
                $tag=Tag::whereIn('name',$tag_ids)->pluck('id')->toArray();
                $tag_post_id=PostTag::whereIn('tag_id',$tag)->pluck('post_id')->toArray();

                $relatedPosts_query = Post::with('Category','photo','view_type')->where('active',1)->where('id','<>',$post_details->id)->where('published_at','<',$date_now)
                    ->whereIn('id',$tag_post_id)->orderBy('published_at','DESC');

                if($relatedPosts_query->count() >0)
                {

                    $relatedPosts =$relatedPosts_query->select(DB::raw('*,(select count(*) from `post_tags` as `pt`where `pt`.`post_id`=`posts`.`id` and `tag_id` IN('.implode(',',$tag_post_id).')) as tags_count'))
                        ->orderBy('published_at','DESC')->orderBy('tags_count','desc')
                        ->take(4)
                        ->get();

                    $relatedPostsCount=count($relatedPosts);
                    $relatedPostsList=$relatedPosts_query->take(3)->pluck("id")->toArray();

                }
                else {
                    $relatedPosts= $relatedPosts_query->orderBy('published_at','DESC')->get();
                    $relatedPostsCount=0;
                    $relatedPostsList=array();
                }
            }
            $count_line=substr_count( $news_details, "\n" );
            $half=(int)($count_line/2);
            $news_details_line=[];
            $sss=strlen($news_details);
            if($sss>1800){
                $numLine = explode("\n",$news_details);
                for ($x=0;$x<count($numLine);$x++){
                    if($x==($half)) {
                        $dat_reed_mor = '';
                        $read_select = ReadMorePost::where('post_id', $id)->pluck('more_post_id')->take(2)->toArray();
                        $relatedPosts_inside = Post::with('Category', 'photo', 'view_type')->where('active', 1)->whereIn('id', $read_select)->where('id', '<>', $post_details->id)->where('published_at', '<', $date_now)->orderBy('order', 'DESC')->take(2)->get();
                        if (empty($relatedPosts_inside)) {
                            $relatedPosts_inside = Post::with('Category', 'photo', 'view_type')->where('active', 1)->where('category_id', $post_details->category_id)->where('id', '<>', $post_details->id)->where('published_at', '<', $date_now)->orderBy('order', 'DESC')->take(2)->get();

                        }

                        foreach ($relatedPosts_inside as $post) {
                            $post_url = url('post/' . $post->id . '/' . (implode('-', explode(' ', $post->title))));
                            $img_post = asset($post->photo->thump);
                            $dat_reed_mor .= '<article class="read-more-item">
                                    <a href="' . $post_url . '">
                                        <img src="' . $img_post . '" />
                                        <span>' . $post->title . '</span>
                                    </a>
                                </article>';

                        }
                        $image_url = asset('homeStyle/images/ads-full.png');
                        if($this->adv_setting[1]->adv_part_5!=5){
                            $news_details_line[] .= '
                                <section class="section main-ads-section" style="margin-bottom: 30px;">';
                            if ($this->adv_setting[1]->adv_part_5 == 1) {
                                $news_details_line[] .= '<div class="row main-ads one-ads" data-layout="1">
                    <div class="col-xs-12">';
                                if ($adv_part_5 && $adv_part_5->iframe1) {

                                    $news_details_line[] .= $adv_part_5->iframe1;
                                } elseif ($adv_part_5 && $adv_part_5->image1) {
                                    $news_details_line[] .= '<a href = "' . $this->get_url_image($adv_part_5->url1) . '" >
                                <img src = "' . $this->get_url_image($adv_part_5->image1) . '" /></a >';
                                } else {
                                    $news_details_line[] .= '<a href="#">
                                <img src="' . $this->get_url_image('homeStyle/images/ads-full.png') . '" /></a>';
                                }
                                $news_details_line[] .= '</div></div>';
                            }
                            if ($this->adv_setting[1]->adv_part_5 == 2) {
                                $news_details_line[] .= '<div class="row main-ads two-ads" data - layout = "2" >
                    <div class="col-xs-12 col-sm-6" >';
                                if ($adv_part_5 && $adv_part_5->iframe1) {

                                    $news_details_line[] .= $adv_part_5->iframe1;
                                } elseif ($adv_part_5 && $adv_part_5->image1) {
                                    $news_details_line[] .= '<a href = "' . $this->get_url_image($adv_part_5->url1) . '" >
                                <img src = "' . $this->get_url_image($adv_part_5->image1) . '" /></a >';
                                } else {
                                    $news_details_line[] .= '<a href="#">
                                <img src="' . $this->get_url_image('homeStyle/images/ads-half.png') . '" /></a>';
                                }
                                $news_details_line[] .= '</div >
                    <div class="col-xs-12 col-sm-6" >';
                                if ($adv_part_5 && $adv_part_5->iframe2) {

                                    $news_details_line[] .= $adv_part_5->iframe2;
                                } elseif ($adv_part_5 && $adv_part_5->image2) {
                                    $news_details_line[] .= '<a href = "' . $this->get_url_image($adv_part_5->url2) . '" >
                                <img src = "' . $this->get_url_image($adv_part_5->image2) . '" /></a >';
                                } else {
                                    $news_details_line[] .= '<a href="#">
                                <img src="' . $this->get_url_image('homeStyle/images/ads-half.png') . '" /></a>';
                                }
                                $news_details_line[] .= '</div ></div >';
                            }
                            if ($this->adv_setting[1]->adv_part_5 == 3) {
                                if ($adv_part_5 && $adv_part_5->iframe1) {

                                    $news_details_line[] .= $adv_part_5->iframe1;
                                } elseif ($adv_part_5 && $adv_part_5->image1) {
                                    $news_details_line[] .= '<a href = "' . $this->get_url_image($adv_part_5->url1) . '" >
                                <img src = "' . $this->get_url_image($adv_part_5->image1) . '" /></a >';
                                } else {
                                    $news_details_line[] .= '<a href="#">
                                <img src="' . $this->get_url_image('homeStyle/images/ads-three.png') . '" /></a>';
                                }
                                $news_details_line[] .= '</div >
                    <div class="col-xs-12 col-sm-4" >';
                                if ($adv_part_5 && $adv_part_5->iframe2) {

                                    $news_details_line[] .= $adv_part_5->iframe2;
                                } elseif ($adv_part_5 && $adv_part_5->image2) {
                                    $news_details_line[] .= '<a href = "' . $this->get_url_image($adv_part_5->url2) . '" >
                                <img src = "' . $this->get_url_image($adv_part_5->image2) . '" /></a >';
                                } else {
                                    $news_details_line[] .= '<a href="#">
                                <img src="' . $this->get_url_image('homeStyle/images/ads-three.png') . '" /></a>';
                                }
                                $news_details_line[] .= '</div >
                    <div class="col-xs-12 col-sm-4" >';
                                if ($adv_part_5 && $adv_part_5->iframe3) {

                                    $news_details_line[] .= $adv_part_5->iframe3;
                                } elseif ($adv_part_5 && $adv_part_5->image3) {
                                    $news_details_line[] .= '<a href = "' . $this->get_url_image($adv_part_5->url3) . '" >
                                <img src = "' . $this->get_url_image($adv_part_5->image3) . '" /></a >';
                                } else {
                                    $news_details_line[] .= '<a href="#">
                                <img src="' . $this->get_url_image('homeStyle/images/ads-three.png') . '" /></a>';
                                }
                                $news_details_line[] .= '</div >
                     </div >';

                            }
                            if ($this->adv_setting[1]->adv_part_5 == 4) {
                                $news_details_line[] .= '<div class="col-xs-12 col-sm-3" >';
                                if ($adv_part_5 && $adv_part_5->iframe1) {

                                    $news_details_line[] .= $adv_part_5->iframe1;
                                } elseif ($adv_part_5 && $adv_part_5->image1) {
                                    $news_details_line[] .= '<a href = "' . $this->get_url_image($adv_part_5->url1) . '" >
                                <img src = "' . $this->get_url_image($adv_part_5->image1) . '" /></a >';
                                } else {
                                    $news_details_line[] .= '<a href="#">
                                <img src="' . $this->get_url_image('homeStyle/images/ads-four.png') . '" /></a>';
                                }
                                $news_details_line[] .= '</div >
                    <div class="col-xs-12 col-sm-3" >';
                                if ($adv_part_5 && $adv_part_5->iframe2) {

                                    $news_details_line[] .= $adv_part_5->iframe2;
                                } elseif ($adv_part_5 && $adv_part_5->image2) {
                                    $news_details_line[] .= '<a href = "' . $this->get_url_image($adv_part_5->url2) . '" >
                                <img src = "' . $this->get_url_image($adv_part_5->image2) . '" /></a >';
                                } else {
                                    $news_details_line[] .= '<a href="#">
                                <img src="' . $this->get_url_image('homeStyle/images/ads-four.png') . '" /></a>';
                                }
                                $news_details_line[] .= '</div >
                    <div class="col-xs-12 col-sm-3" >';
                                if ($adv_part_5 && $adv_part_5->iframe3) {

                                    $news_details_line[] .= $adv_part_5->iframe3;
                                } elseif ($adv_part_5 && $adv_part_5->image3) {
                                    $news_details_line[] .= '<a href = "' . $this->get_url_image($adv_part_5->url3) . '" >
                                <img src = "' . $this->get_url_image($adv_part_5->image3) . '" /></a >';
                                } else {
                                    $news_details_line[] .= '<a href="#">
                                <img src="' . $this->get_url_image('homeStyle/images/ads-four.png') . '" /></a>';
                                }
                                $news_details_line[] .= '</div >
                    <div class="col-xs-12 col-sm-3" >';
                                if ($adv_part_5 && $adv_part_5->iframe4) {

                                    $news_details_line[] .= $adv_part_5->iframe4;
                                } elseif ($adv_part_5 && $adv_part_5->image4) {
                                    $news_details_line[] .= '<a href = "' . $this->get_url_image($adv_part_5->url4) . '" >
                                <img src = "' . $this->get_url_image($adv_part_5->image4) . '" /></a >';
                                } else {
                                    $news_details_line[] .= '<a href="#">
                                <img src="' . $this->get_url_image('homeStyle/images/ads-four.png') . '" /></a>';
                                }
                                $news_details_line[] .= '</div >
                    </div >';

                            }

                            $news_details_line[] .= '</section>';
                        }
                        if(count($relatedPosts_inside)){
                            $news_details_line[]='<div class="read-more-news">
                                <div class="read-more-title">إقرأ أيضاً</div>
                                '.$dat_reed_mor.'
                                
                            </div>';
                        }

                    }

                    $news_details_line[]=$numLine[$x];
                }
                $news_details_line=implode("\n",$news_details_line);
            }else{
                $news_details_line=$news_details;
            }

            $post_details->read_number=$post_details->read_number+1;
            $new_read=new PostRead();
            $new_read->post_id=$id;
            $new_read->save();

            $relatedPostRest= Post::with('Category','photo','view_type')->where('active',1)->where('category_id',$post_details->category_id)->where('id','<>',$post_details->id)->where('published_at','<',$date_now)
                ->whereNotIn('id',$relatedPostsList)
                ->orderBy('id','DESC')
                ->where('category_id',$post_details->category_id)
                ->take(3-$relatedPostsCount)
                ->pluck("id")->toArray();
            //$related_posts_id=array_merge($relatedPostsList,$relatedPostRest);
            $relatedPosts_query=Post::where('id','<>',$post_details->id)->where("category_id",$post_details->category_id)->orderBy('id','DESC')->take(3)->get();
            $count_like=PostReaction::where('post_id',$post_details->id)->where('reaction','like')->count();
            $count_haha=PostReaction::where('post_id',$post_details->id)->where('reaction','haha')->count();
            $count_wow=PostReaction::where('post_id',$post_details->id)->where('reaction','wow')->count();
            $count_sad=PostReaction::where('post_id',$post_details->id)->where('reaction','sad')->count();
            $count_angry=PostReaction::where('post_id',$post_details->id)->where('reaction','angry')->count();
            if (strpos($news_details_line, '../../../') !== false) {
                $news_details_line=str_replace("../../../","../../",$news_details_line);
            }

            $chosen = MainPost::with('Category', 'photo', 'view_type')->where('id','<>',$id)->where('chosen',1)->where('active', 1)->where('published_at', '<', $date_now)->orderBy('order', 'DESC')->take(5)->get();
            return view('home.post_details',compact('post_tags','relatedPosts_cat','html_face','video','adv1','adv3','adv4','adv5','last_two_post','last_two_post_Art','adv2','device','news_details_line','post_details','last_add','relatedPosts_query','chosen'
            ,'adv_part_1_1' ,'adv_part_2' ,'adv_part_3' ,'adv_part_4' ,'adv_part_6' ,'adv_part_7','adv_part_8','next_post','previous_post'
            ,'count_like','count_haha','count_wow','count_sad','count_angry'));
        }else{
            abort(404);
        }
    }

    public function album_details($id,$title){
        $album=Albom::find($id);
        if($album){
            $images=FileLibrary::where('album_id',$id)->orderBy('id','DESC')->get();
            return view('home.album_details',compact('album','images'));

        }else{
            abort(404);
        }


    }
    public function galleries(){

        $albums=Albom::where('active',1)->with('photoscover')->orderBy('id','DESC')->paginate(8);
            return view('home.galleries',compact('albums'));

    }
    public function studio(){

        $images=FileLibrary::with('album')->whereNotNull('album_id')->orderBy('id','DESC')->paginate(15);

        return view('home.studio',compact('images'));

    }
    public function categories($id){
        $category=Category::find($id);
        $date_now=date('Y-m-d H:i:s');

        if($category){
            $posts= Post::with('Category', 'photo', 'view_type')->where('category_id',$id)->where('active', 1)->where('published_at', '<', $date_now)->orderBy('order', 'DESC')->paginate(16);
            return view('home.category',compact('posts','category'));

        }else{
            abort(404);
        }


    }
    public function search_deatails(Request $request){
        $date_now=date('Y-m-d H:i:s');
        $key=$request->key;

        if($key){
            $posts= Post::with('Category', 'photo', 'view_type')->where('title', 'like', "%$key%")->where('active', 1)->where('published_at', '<', $date_now)->orderBy('order', 'DESC')->paginate(16);
            return view('home.search_result',compact('posts','key'));

        }else{
            abort(404);
        }


    }

    public function news()
    {
        $post_id_array=[];
        $date_now=date('Y-m-d H:i:s');


        $last_news_main= Post::with('Category','photo','view_type')->whereNotIn('id',$post_id_array)->where('active',1)->where('published_at','<',$date_now)->orderBy('published_at','DESC')->take(10);
        $last_news_id=$last_news_main->pluck('id')->toArray();
        $post_id_array=array_merge($post_id_array,$last_news_id);
        $last_news_main=$last_news_main->get();
        /////////////////////////////////
        $category_position_1=Category::where('id',4)->first();

        if($category_position_1) {
            $posts_category_1 = Post::with('Category', 'photo', 'view_type')->whereNotIn('id',$post_id_array)->where('category_id',$category_position_1->id)->where('active', 1)->where('published_at', '<', $date_now)->orderBy('order', 'DESC')->take(10)->get();
        }
        $category_position_2=Category::where('id',3)->first();
        if($category_position_2) {

            $posts_category_2 = Post::with('Category', 'photo', 'view_type')->whereNotIn('id',$post_id_array)->where('category_id',$category_position_2->id)->where('active', 1)->where('published_at', '<', $date_now)->orderBy('order', 'DESC')->take(10)->get();

        }
        $category_position_3=Category::where('id',20)->first();
        if($category_position_3) {
            $posts_category_3 = Post::with('Category', 'photo', 'view_type')->whereNotIn('id',$post_id_array)->where('category_id',$category_position_3->id)->where('active', 1)->where('published_at', '<', $date_now)->orderBy('order', 'DESC')->take(10)->get();

        }
        /****/
        $category_position_4=Category::where('id',15)->first();
        if($category_position_4) {
            $posts_category_4 = Post::with('Category', 'photo', 'view_type')->whereNotIn('id',$post_id_array)->where('category_id',$category_position_4->id)->where('active', 1)->where('published_at', '<', $date_now)->orderBy('order', 'DESC')->take(10)->get();
        }


        return view('home.news',compact('last_news_main','category_position_1','category_position_2','category_position_3'
            ,'category_position_4','posts_category_1','posts_category_2','posts_category_3','posts_category_4'));
    }

    public function hotels(){
        $date_now=date('Y-m-d H:i:s');

        $hotels=Hotel::with('photo')->orderBy('id','DESC')->paginate(15);
        $chosen = MainPost::with('Category', 'photo', 'view_type')->where('chosen',1)->where('active', 1)->where('published_at', '<', $date_now)->orderBy('order', 'DESC')->take(5)->get();
        $visitor_new=['ip'=>ip_info(),'country'=>'adasdasd'];
        if($visitor_new['country']=="Palestine" || $visitor_new['country']=="Israel"){
            $adv_part_1_1=Adv::where('page','hotels')->where('position',1)->where('location','ps')->orderBy('id','DESC')->first();
            if(!$adv_part_1_1){
                $adv_part_1_1=Adv::where('page','hotels')->where('position',1)->orderBy('id','DESC')->first();

            }
        }else{
            $adv_part_1_1=Adv::where('page','hotels')->where('position',1)->where(function ($ss){
                $ss->where('location','other')->orWhere('location','all');
            })->orderBy('id','DESC')->first();
        }
        if($visitor_new['country']=="Palestine" || $visitor_new['country']=="Israel"){
            $adv_part_2=Adv::where('page','hotels')->where('position',2)->where('location','ps')->orderBy('id','DESC')->first();
            if(!$adv_part_2){
                $adv_part_2=Adv::where('page','hotels')->where('position',2)->orderBy('id','DESC')->first();

            }
        }else{
            $adv_part_2=Adv::where('page','hotels')->where('position',2)->where(function ($ss){
                $ss->where('location','other')->orWhere('location','all');
            })->orderBy('id','DESC')->first();
        }
        ///////
        if($visitor_new['country']=="Palestine" || $visitor_new['country']=="Israel"){
            $adv_part_3=Adv::where('page','hotels')->where('position',3)->where('location','ps')->orderBy('id','DESC')->first();
            if(!$adv_part_3){
                $adv_part_3=Adv::where('page','hotels')->where('position',3)->orderBy('id','DESC')->first();

            }
        }else{
            $adv_part_3=Adv::where('page','hotels')->where('position',3)->where(function ($ss){
                $ss->where('location','other')->orWhere('location','all');
            })->orderBy('id','DESC')->first();
        }
        /////////
///////
        if($visitor_new['country']=="Palestine" || $visitor_new['country']=="Israel"){
            $adv_part_4=Adv::where('page','hotels')->where('position',4)->where('location','ps')->orderBy('id','DESC')->first();
            if(!$adv_part_4){
                $adv_part_4=Adv::where('page','hotels')->where('position',4)->orderBy('id','DESC')->first();

            }
        }else{
            $adv_part_4=Adv::where('page','hotels')->where('position',4)->where(function ($ss){
                $ss->where('location','other')->orWhere('location','all');
            })->orderBy('id','DESC')->first();
        }        return view('home.hotels',compact('hotels','chosen','adv_part_1_1','adv_part_2','adv_part_3','adv_part_4'));

    }
    public function chosen_news(){
        $date_now=date('Y-m-d H:i:s');

        $posts = Post::with('Category', 'photo', 'view_type')->where('chosen',1)->where('active', 1)->where('published_at', '<', $date_now)->orderBy('order', 'DESC')->paginate(16);
            return view('home.chosen',compact('posts'));

    }

    public function videos(){

        $videos=Video::where('active',1)->with('photo')->orderBy('id','DESC')->paginate(12);
        return view('home.videos',compact('videos'));

    }
    public function post_tags($id,$title){
        $date_now=date('Y-m-d H:i:s');


        $tag=Tag::find($id);
        $posts=[];
        if($tag){
            $post_tag=PostTag::where('tag_id',$id)->pluck('post_id')->toArray();
            $posts = Post::with('Category','photo','view_type')->where('active',1)->where('published_at','<',$date_now)->orderBy('order','DESC')
                ->whereIn('id',$post_tag)->paginate(16);

        }



        return view('home.post_tags',compact('posts','tag'));

    }
    private function get_url_image($url){
    return asset($url);
    }
    public function page($id){
        $page=Page::find($id);
        if($page){
            return view('home.page',compact('page'));

        }else{
            abort(404);
        }


    }
    public function contactus(){


        return view('home.contactus');

    }
    public function contact_us(Request $request)
    {
        $this->validate($request, [
            'name'      => 'required|max:255',
            'email'      => 'required|email',
            'news_title'      => 'required',
            'details'      => 'required',
        ], [], [
            'name'      => 'الإسم',
            'email'      => 'البريد الإلكتروني',
            'news_title'      => 'عنوان الرسالة',
            'details'      => 'التفاصيل',
        ]);


        $old_mail=Countact::where('type','message')->where('sender_ip',getUserIP())->where('date_send',date('Y-m-d'))->count();

        if($old_mail>4){
            $message = 'لقد تجاوزت الحد الأقصى لارسال الرسائل لهذا اليوم . يمكنك المحاولة غدا';

            return response()->json(compact('message'),404);
        }
        $mail=new Countact();

        $mail->name=$request->name;
        $mail->email=$request->email;
        $mail->title=$request->news_title;
        $mail->details=$request->details;
        $mail->type='message';
        $mail->sender_ip=getUserIP();
        $mail->date_send=date('Y-m-d');
        $mail->save();



        $message = 'تم ارسال رسالتك بنجاح. سنرد عليك في اسرع وقت ممكن';

        return response()->json(compact('message'));
    }

    public function get_urgent(){
        $urgents = Urgent::where('end_view','>',Carbon::now())->get();

            return response()->json(compact('urgents'));
    }

    public function post_reaction(Request $request)
    {

        $visitor_data=ip_info();
         $check=PostReaction::where('post_id',$request->post_id)->where('ip',$visitor_data)->first();
         if(!$check){
             $mail=new PostReaction();
             $mail->post_id=$request->post_id;
             $mail->reaction=$request->type;
             $mail->ip=$visitor_data;
             $mail->save();

             $message = 'تم التفاعل';
             $count_reaction=PostReaction::where('post_id',$request->post_id)->where('reaction',$request->type)->count();

             return response()->json(compact('message','count_reaction'));
         }else{
             $message='لقد قمت بالتفاعل مسبقا';
             return response()->json(compact('message'),404);
         }

    }
    public function print_post($id)
    {
        $date_now=date('Y-m-d H:i:s');


        $post_details=Post::with('Category','photo','Video','PostPhoto','view_type')->where('id',$id)->first();
 return view('home.post_print',compact('post_details'));

    }

}