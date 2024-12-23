<?php

namespace App\Http\Controllers;

use App\Models\Albom;
use App\Models\AttendanceLog;

use App\Models\MainPost;
use App\Models\Post;
use App\Models\RecorderLogin;
use App\Models\Setting;
use App\Models\Subscription;
use App\Models\UserLog;
use App\Models\Video;
use App\Models\Visitor;
use App\User;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Auth;
use DB;

class DashboardController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        meta('title', 'الرئيسية');
        $date_now = date('Y-m-d H:i:s');
        $breadcrumb = breadcrumbs()
            ->add('الرئيسية','#', 'icon-home')
            ->add(meta('title'));
        $all_visitor=Visitor::count();
        $visitor_from_gaza=Visitor::where('city','Gaza')->count();
        $vistor_from_palestine=Visitor::where('country','Palestine')->count();
        $vistor_form_out=Visitor::where('country','<>','Palestine')->count();
        $all_post=Post::count();
        $all_post_not_active=Post::where('active',0)->count();
        $all_artical=Post::whereNotNull('writer_id')->count();
        $all_cases_post=Post::whereNotNull('case_id')->count();

        meta('breadcrumb', $breadcrumb->render());
        $monthly_posts = Post::where('published_at', '>=', Carbon::now()->subMonth())->count();
        $daily_posts = Post::where('published_at', '>=', Carbon::now()->subDay())->count();
        $monthly_views = Post::where('published_at', '>=', Carbon::now()->subMonth())->sum('read_number');
        $daily_views = Post::where('published_at', '>=', Carbon::now()->subDay())->sum('read_number');
        $monthly_photo_galleries = Albom::where('created_at', '>=', Carbon::now()->subMonth())->count();
        $monthly_Videos = Video::where('created_at', '>=', Carbon::now()->subMonth())->count();

        $lastPosts = MainPost::where('published_at', '<', $date_now)->orderBy('published_at', 'DESC')->limit(10)->get();
        $albums = Albom::with('photos')->orderBy('id', 'DESC')->take(10)->get();
        $videos = Video::with('photo')->orderBy('id', 'DESC')->take(10)->get();

        $monthly_most_views = MainPost::where('created_at', '>=', Carbon::now()->subMonth())->orderBy('read_number', 'DESC')->limit(5)->get();
        $daily_most_views = MainPost::where('created_at', '>=', Carbon::now()->subDay())->orderBy('read_number', 'DESC')->limit(5)->get();

        $monthly_most_users_views = DB::table('users')
            ->join('posts', 'posts.user_id', '=', 'users.id')
            ->groupBy('users.id')
            ->where('posts.published_at', '>=', Carbon::now()->subMonth())
            ->selectRaw('max(users.name) as username, sum(posts.read_number) as sum_views')
            ->orderBy('sum_views', 'desc')
            ->get();
        $monthly_most_users_posts = DB::table('users')
            ->join('posts', 'posts.user_id', '=', 'users.id')
            ->groupBy('users.id')
            ->where('posts.published_at', '>=', Carbon::now()->subMonth())
            ->selectRaw('max(users.name) as username, count(posts.id) as post_count')
            ->orderBy('post_count', 'desc')
            ->get();
//        dd($monthly_most_users_posts);
        $university1=Post::where('university_id','جامعة بيرزيت')->count();
        $university2=Post::where('university_id','جامعة النجاح')->count();
        $university3=Post::where('university_id','جامعة البوليتكنك')->count();
        $university4=Post::where('university_id','جامعة الخليل')->count();
        $university5=Post::where('university_id','الكلية العصرية')->count();
        $university6=Post::where('university_id','جامعة القدس/ أبو ديس')->count();
        $university7=Post::where('university_id','دار المعلمين')->count();
        $university8=Post::where('university_id','جامعة فلسطين الأهلية')->count();
        $university9=Post::where('university_id','جامعة خضوري')->count();
        $university10=Post::where('university_id','جامعة الأمريكية')->count();
        return view('dashboards.index', compact('monthly_posts', 'daily_views', 'daily_posts', 'monthly_views', 'monthly_photo_galleries',
            'monthly_Videos', 'lastPosts', 'albums', 'videos', 'monthly_most_views','daily_most_views', 'monthly_most_users_views','monthly_most_users_posts'
            ,'all_visitor','visitor_from_gaza','vistor_from_palestine','vistor_form_out'
            ,'all_post','all_post_not_active','all_artical','all_cases_post','university1','university2','university3','university4','university5','university6','university7','university8',
            'university9','university10'));


        /*   return view('dashboards.index',compact('all_visitor','visitor_from_gaza','vistor_from_palestine','vistor_form_out'
          ,'all_post','all_post_not_active','all_artical','all_cases_post'));*/
    }
    public function edit_setting()
    {
        meta('title', 'اعدادات الموقع');

        $breadcrumb = breadcrumbs()
            ->add('اعدادات الموقع','#', 'icon-home')
            ->add(meta('title'));

        meta('breadcrumb', $breadcrumb->render());

        $setting=Setting::find(1);


        return view('dashboards.setting.form',compact('setting'));
    }
    public function update_setting(Request $request)
    {


        $setting=Setting::find(1);
            $setting->web_site_name=$request->web_site_name;
            $setting->mobile=$request->mobile;
            $setting->facebook=$request->facebook;
            $setting->instagram=$request->instagram;
			$setting->email=$request->email;
            $setting->twitter=$request->twitter;
			$setting->main_post_template=$request->main_post_template;
            $setting->phone=$request->phone;
            $setting->youtube=$request->youtube;
            $setting->googepluse=$request->googepluse;
            $setting->whatsapp=$request->whatsapp;
			$setting->telegram=$request->telegram;
            $setting->nabd=$request->nabd;
            $setting->android=$request->android;
            $setting->iphone=$request->iphone;
            $setting->main_tags=$request->main_tags;
        $setting->head_script=$request->head_script;
        $setting->footer_script=$request->footer_script;
        $setting->soundcloud=$request->soundcloud;
        $setting->google_analytics=$request->google_analytics;
        $setting->description=$request->description;
        $setting->save();
        $message = 'تمت التعديل بنجاح';
        return response()->json(compact('message'));
    }

    public function user_logs()
    {
        meta('title', 'سجل حركات المستخدمين');

        $breadcrumb = breadcrumbs()
            ->add('المستخدمين','#', 'icon-home')
            ->add(meta('title'));

        meta('breadcrumb', $breadcrumb->render());

        $users=User::get();


        return view('dashboards.setting.user_log',compact('users'));
    }
    public function user_record()
    {
        meta('title', 'سجل دخول وخروج المستخدمين');

        $breadcrumb = breadcrumbs()
            ->add('المستخدمين','#', 'icon-home')
            ->add(meta('title'));

        meta('breadcrumb', $breadcrumb->render());

        $users=User::get();


        return view('dashboards.setting.user_record',compact('users'));
    }
    public function search_user_logs(Request $request)
    {
        $filter = json_decode(request('filter'));
        $posts = UserLog::with('user')->where(function ($query) use ($filter) {

            if (isset($filter->start_date) && isset($filter->end_date)) {
                if ($filter->start_date && $filter->end_date) {

                    $published_at = date('Y-m-d H:i:s', strtotime($filter->start_date));
                    $published_to = date('Y-m-d H:i:s', strtotime($filter->end_date));
                    $query->whereBetween('created_at', [$published_at, $published_to]);

                }
            }
            if ($filter->user_id) {
                $query->where('user_id', "$filter->user_id");
            }
            if ($filter->event) {
                $query->where('event', "$filter->event");
            }
            if ($filter->table) {
                $query->where('logable_type', "$filter->table");
            }

        });

            $logs_count=$posts->count();

        if (request()->has('sort') && request()->sort!='{"fieldName":"created_at","order":"desc"}') {
            $sort = json_decode(request('sort'), true);
            $posts = $posts->orderBy(($sort['fieldName'] ?? 'id'), $sort['order']);
        }


        $posts = $posts->orderBy('id', 'DESC')->paginate(15);

        return response()->json(compact('posts','logs_count'));
    }
    public function search_user_record(Request $request)
    {
        $filter = json_decode(request('filter'));
        $posts = RecorderLogin::with('user')->where(function ($query) use ($filter) {

            if (isset($filter->start_date) && isset($filter->end_date)) {
                if ($filter->start_date && $filter->end_date) {

                    $published_at = date('Y-m-d H:i:s', strtotime($filter->start_date));
                    $published_to = date('Y-m-d H:i:s', strtotime($filter->end_date));
                    $query->whereBetween('created_at', [$published_at, $published_to]);

                }
            }
            if ($filter->user_id) {
                $query->where('user_id', "$filter->user_id");
            }


        });


        if (request()->has('sort') && request()->sort!='{"fieldName":"created_at","order":"desc"}') {
            $sort = json_decode(request('sort'), true);
            $posts = $posts->orderBy(($sort['fieldName'] ?? 'id'), $sort['order']);
        }


        $posts = $posts->orderBy('id', 'DESC')->paginate(15);

        return response()->json(compact('posts'));
    }

    public function open_session(){
//      $recorder=new RecorderLogin();
//        $recorder->user_id=auth()->user()->id;
//        $recorder->event_date=date('Y-m-d');
//        $recorder->login_time=date('H:i:s');
//        $recorder->save();
    }

    public function close_session(){

//        $recorder=RecorderLogin::where('user_id',auth()->user()->id)->where('event_date',date('Y-m-d'))->orderby('id','DESC')->first();
//
//        if($recorder){
//            $start=$recorder->event_date.' '.$recorder->login_time;
//            $startTime = Carbon::parse($start);
//            $finishTime = Carbon::parse(date("Y-m-d H:i:s"));
//            $totalDuration = $finishTime->diffInMinutes($startTime);
//            $recorder->logout_time=date("H:i:s");
//            $recorder->duration=$totalDuration;
//            $recorder->save();
//        }
    }


}