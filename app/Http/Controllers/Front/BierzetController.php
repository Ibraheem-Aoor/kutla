<?php

namespace App\Http\Controllers\Front;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Albom;
use App\Models\Video;
use App\Models\Category;
use App\Link;
use App\Releas;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\FileLibrary;
use App\Models\MainPost;

class BierzetController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function index()
    {
        $users = User::where('active', '=', '1')->pluck('id')->toArray();
        $posts = MainPost::with('User')
            ->orderBy('created_at', 'desc')
            ->where('active', '=', '1')
            ->whereIn('user_id', $users)
            ->take(6)
            ->get();
        $popular = MainPost::with('User')
            ->orderBy('view_count', 'desc')
            ->whereIn('user_id', $users)
            ->take(9)
            ->get();
        $photo = Albom::with('photos')->where('active', '=', '1')
            ->latest()->get()->take(10);

        $videos = Video::where('active', '=', '1')->latest()->get()->take(10);

        $private = null;//Post::privetFile()->first();

        $sliders = MainPost::slider()->latest()->get()->take(10);


        $linkes  = Link::orderBy('created_at','desc')->get()->take(10);
        $releas  = Releas::latest()->first();
        $statments = MainPost::statment()->latest()->get()->take(10);

        $posts   = MainPost::with('Category')->news()->latest()->get()->take(10);

        //  dd($photo);

        return view('kotla_bizert.index', compact('statments','linkes','releas','sliders','private','posts', 'users', 'popular', 'photo', 'videos'));
    }

    public function category_posts( Request $request,Category $category ,$slug){

        $name=$category->name;

        $posts = Post::general()->where('category_id',$category->id);
        if($request->sort){
            $posts->orderBy('created_at',$request->sort);
        }
        if($request->search){
            $posts->where('title','LIKE',"%{$request->search}%");
        }
        $posts = $posts->orderBy('view_count','desc')->paginate(12);

        return view('kotla_bizert.posts',compact('posts','name'));
    }

    public function category_show( Request $request,$slug){

        if($slug =='معرض-الوسائط'){
            return $this->geMedia($request);
        }
        if($slug =='الاصدارات'){

            return $this->getRelase($request);
        }
        if($slug == 'الاكثر-قراءة'){
            return $this->mostRead($request);
        }if($slug == 'بيانات'){
            return $this->getStatment($request);
        }
        $category= Category::where('slug',$slug)->first();
        $name=$category->name;
        $posts = Post::where('category_id',$category->id);
        if($request->sort){
            $posts->orderBy('created_at',$request->sort);
        }
        if($request->search){
            $posts->where('title','LIKE',"%{$request->search}%");
        }
        $posts = $posts->orderBy('view_count','desc')->paginate(12);

        return view('kotla_bizert.posts',compact('posts','name'));
    }

    public function post_show(Post $post,$slug){
        // dd(MainPost::find($post));
        $users = User::where('active', '=', '1')->pluck('id')->toArray();
        $related = MainPost::where('category_id', '=', $post->Category->id)
            ->where('id', '!=', $post->id)
            ->where('active', '=', '1')
            ->whereIn('user_id', $users)
            ->orderBy('created_at', 'desc')
            ->get()
            ->take(5);
        $popular = MainPost::popular()->get()->take(5);

        $postKey = 'post_' . $post->id;
        if (!\Session::has($postKey)) {
            $viewCount = $post->view_count + 1;
            $main = MainPost::where('post_id',$post->id)->first();
            $post->update(['view_count' => $viewCount]);
            $post->update(['read_number' => $viewCount]);
            if($main){
                $main->update(['view_count' => $viewCount]);
                $main->update(['read_number' => $viewCount]);
            }
            \Session::put($postKey, 1);
        }


        return view('kotla_bizert.post-view',compact('popular','related','post'));

    }

    public function allNews(Request $request){

        $name="الاخبار";
        $posts = Post::news()->orderBy('created_at','desc');
        if($request->sort ){
            $posts->orderBy('created_at',$request->sort);
        }
        if($request->search){
            $posts->where('title','LIKE',"%{$request->search}%");
        }
        $posts = $posts->paginate(12);

        return view('kotla_bizert.posts',compact('posts','name'));
    }


    public function mostRead(){
        $name = 'الاكثر قراءة';
        $posts = Post::popular()->paginate(12);
        return view('kotla_bizert.posts',compact('posts','name'));
    }

    public function aboutUs(){
        $name = "من نحن ";
        $setting = \App\Models\Page::first();
        //dd($setting);
        return view('kotla_bizert.about_us',compact('setting'));

    }

    public function tag(Tag $tag)
    {
        $users = User::where('active', '=', '1')->pluck('id')->toArray();
        $name = $tag->name;
        $posts=$tag->post()
            ->where('active','=', 1)
            ->whereIn('user_id',$users)->paginate(12);

        return view('kotla_bizert.posts', compact( 'posts','name'));
    }

    public function getRelase(Request $request){

        $name='الاصدارات';
        $posts = Releas::query();
        if($request->sort){
            $posts->orderBy('created_at',$request->sort);
        }
        if($request->search){
            $posts->where('title','LIKE',"%{$request->search}%");
        }
        $relases = $posts->paginate(12);

        return view('kotla_bizert.relase',compact('relases','name'));

    }

    public function getStatment(Request $request){

        $name='بيانات';
        $posts = Post::statment();
        if($request->sort){
            $posts->orderBy('created_at',$request->sort);
        }
        if($request->search){
            $posts->where('title','LIKE',"%{$request->search}%");
        }
        $posts = $posts->paginate(12);

        return view('kotla_bizert.posts',compact('posts','name'));

    }

    public function geMedia(Request $request){


        $name='معرض الوسائط';

        if($request->type=='video'){
            $videos=Video::where('active',1)->orderBy('id','DESC')->paginate(12);
            return view('katlo_front.video',compact('videos','name'));
        }
        $alboms=Albom::where('active',1)->paginate(12);

        return view('kotla_bizert.media',compact('alboms','name'));

    }
    public function show_photo(Albom $albom){


        $name='معرض الوسائط';
        $images=FileLibrary::where('album_id',$albom->id)->orderBy('id','DESC')->paginate(12);
        //$images=$albom->photos;
        return view('kotla_bizert.photo',compact('images','name'));
    }
}
