<?php

namespace App\Http\Controllers\Front;

use App\Banner;
use App\Models\MainPost;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use App\Models\Post;
use App\Models\Tag;
use App\Models\Albom;
use App\Models\Video;
use App\Models\Category;
use App\Models\Countact;
use App\Link;
use App\Releas;
use App\Models\MailList;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use App\Models\FileLibrary;

class FrontController extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    /* start link for new website */

    public function new_index()
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
            ->orderBy('published_at','desc')->get()->take(8);

        $videos = Video::where('active', '=', '1')->orderBy('published_at','desc')->get()->take(6);

        $private = null;//Post::privetFile()->first();

        $sliders = MainPost::slider()->latest()->get()->take(5);

        $sliders2 = MainPost::slider()->latest()->take(5)->pluck('id')->toArray();
        $staticPost =MainPost::static()->latest()->first();
        if($staticPost){
            $sliders->prepend($staticPost);
        }


        $linkes  = Link::orderBy('order','asc')->get();
        $releas  = Releas::latest()->first();
        $statments = MainPost::statment()->latest()->get()->take(4);

        $posts   = MainPost::with('Category')->whereNotIn('id',$sliders2)->news()->latest()->get()->take(4);
        $repotes = MainPost::report()->latest()->get()->take(6);
        $banner = Banner::first();

        //  dd($photo);

        return view('new_kotla_front.index', compact('staticPost','banner','repotes','statments','linkes','releas','sliders','private','posts', 'users', 'popular', 'photo', 'videos'));
      //  return view('new_kotla_front', compact('staticPost','banner','repotes','statments','linkes','releas','sliders','private','posts', 'users', 'popular', 'photo', 'videos'));
    }
    public function new_aboutUs(){
        $name = "من نحن ";
        $setting = \App\Models\Page::first();
        //dd($setting);
        return view('new_kotla_front.about_us',compact('setting'));

    }

    public function new_allNews(Request $request){

        $name="الاخبار";
        $posts = Post::news()->orderBy('created_at','desc');
        if($request->sort ){
            $posts->orderBy('created_at',$request->sort);
        }
        if($request->search){
            $posts->where('title','LIKE',"%{$request->search}%");
        }
        $posts = $posts->paginate(12);

        return view('new_kotla_front.posts',compact('posts','name'));
    }
    public function newmostRead(){
        $name = 'الاكثر قراءة';
        $posts = Post::popular()->paginate(12);
        return view('new_kotla_front.posts',compact('posts','name'));
    }

    public function new_category_show( Request $request,$slug){

        if($slug =='معرض-الوسائط'){
            return $this->getnewMedia($request);
        }
        if($slug =='الاصدارات'){

            return $this->getRelase($request);
        }
        if($slug == 'الاكثر-قراءة'){
            return $this->newmostRead($request);
        }if($slug == 'بيانات'){
            return $this->getnewStatment($request);
        }
        if($slug == 'التقارير'){
            return $this->getnewReport($request);
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

       return view('new_kotla_front.posts',compact('posts','name'));
    }
    public function getnewReport(Request $request){

        $name='التقارير';

        $posts = Post::report();
        if($request->sort){
            $posts->orderBy('created_at',$request->sort);
        }
        if($request->search){
            $posts->where('title','LIKE',"%{$request->search}%");
        }
        $posts = $posts->orderBy('created_at','desc')->paginate(12);

        return view('new_kotla_front.posts',compact('posts','name'));


    }
    public function new_tag(Tag $tag)
    {
        $users = User::where('active', '=', '1')->pluck('id')->toArray();
        $name = $tag->name;
        $posts=$tag->post()
            ->where('active','=', 1)
            ->whereIn('user_id',$users)->paginate(12);

        return view('new_kotla_front.posts', compact( 'posts','name'));
    }
    public function getnewStatment(Request $request){

        $name='بيانات';
        $posts = Post::statment();
        if($request->sort){
            $posts->orderBy('created_at',$request->sort);
        }
        if($request->search){
            $posts->where('title','LIKE',"%{$request->search}%");
        }
        $posts = $posts->orderBy('created_at','desc')->paginate(12);

        return view('new_kotla_front.posts',compact('posts','name'));

    }
    public function getnewMedia(Request $request){


        $name='معرض الوسائط';

        if($request->type=='video'){
            $videos=Video::where('active',1) ->orderBy('published_at','desc')->paginate(12);
            return view('new_kotla_front.video',compact('videos','name'));
        }
        $alboms=Albom::where('active',1)->orderBy('published_at','desc')->paginate(12);

        return view('new_kotla_front.media',compact('alboms','name'));

    }

    public function new_show_photo(Albom $albom){

        $name='معرض الوسائط';
        $images=FileLibrary::where('album_id',$albom->id)->orderBy('id','DESC')->paginate(12);
        //$images=$albom->photos;
        return view('new_kotla_front.photo',compact('images','name','albom'));
    }

    public function new_post_show(Post $post,$slug){
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


        return view('new_kotla_front.post-view',compact('popular','related','post'));

    }
    public function new_category_posts( Request $request,Category $category ,$slug){

        $name=$category->name;

        $posts = Post::general()->where('category_id',$category->id);
        if($request->sort){
            $posts->orderBy('created_at',$request->sort);
        }
        if($request->search){
            $posts->where('title','LIKE',"%{$request->search}%");
        }
        $posts = $posts->orderBy('view_count','desc')->paginate(12);

        return view('new_kotla_front.posts',compact('posts','name'));
    }

    public function newcategoryGetAllPost( Request $request,Category $category ){

        $name=$category->name;

        $posts = Post::general()->where('category_id',$category->id);
        if($request->sort){
            $posts->orderBy('created_at',$request->sort);
        }
        if($request->search){
            $posts->where('title','LIKE',"%{$request->search}%");
        }
        $posts = $posts->orderBy('view_count','desc')->paginate(12);

        return view('new_kotla_front.posts',compact('posts','name'));
    }

    public function new_post_show_twitter(Post $post){
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


        return view('new_kotla_front.post-view',compact('popular','related','post'));

    }
    /* end link for new website */


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
            ->orderBy('published_at','desc')->get()->take(6);

        $videos = Video::where('active', '=', '1')->orderBy('published_at','desc')->get()->take(6);

        $private = null;//Post::privetFile()->first();

        $sliders = MainPost::slider()->latest()->get()->take(5);

        $sliders2 = MainPost::slider()->latest()->take(5)->pluck('id')->toArray();
        $staticPost =MainPost::static()->latest()->first();
        if($staticPost){
            $sliders->prepend($staticPost);
        }


        $linkes  = Link::orderBy('created_at','desc')->get();
        $releas  = Releas::latest()->first();
        $statments = MainPost::statment()->latest()->get()->take(3);

        $posts   = MainPost::with('Category')->whereNotIn('id',$sliders2)->news()->latest()->get()->take(4);
        $repotes = MainPost::report()->latest()->get()->take(2);
        $banner = Banner::first();

        //  dd($photo);

        return view('katlo_front.index', compact('staticPost','banner','repotes','statments','linkes','releas','sliders','private','posts', 'users', 'popular', 'photo', 'videos'));
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

        return view('katlo_front.posts',compact('posts','name'));
    }

    public function categoryGetAllPost( Request $request,Category $category ){

        $name=$category->name;

        $posts = Post::general()->where('category_id',$category->id);
        if($request->sort){
            $posts->orderBy('created_at',$request->sort);
        }
        if($request->search){
            $posts->where('title','LIKE',"%{$request->search}%");
        }
        $posts = $posts->orderBy('view_count','desc')->paginate(12);

        return view('katlo_front.posts',compact('posts','name'));
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
        if($slug == 'التقارير'){
            return $this->getReport($request);
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

        return view('katlo_front.posts',compact('posts','name'));
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


        return view('katlo_front.post-view',compact('popular','related','post'));

    }
    public function post_show_twitter(Post $post){
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


        return view('katlo_front.post-view',compact('popular','related','post'));

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

        return view('katlo_front.posts',compact('posts','name'));
    }


    public function mostRead(){
        $name = 'الاكثر قراءة';
        $posts = Post::popular()->paginate(12);
        return view('katlo_front.posts',compact('posts','name'));
    }

    public function aboutUs(){
        $name = "من نحن ";
        $setting = \App\Models\Page::first();
        //dd($setting);
        return view('katlo_front.about_us',compact('setting'));

    }



    public function tag(Tag $tag)
    {
        $users = User::where('active', '=', '1')->pluck('id')->toArray();
        $name = $tag->name;
        $posts=$tag->post()
            ->where('active','=', 1)
            ->whereIn('user_id',$users)->paginate(12);

        return view('katlo_front.posts', compact( 'posts','name'));
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

        return view('katlo_front.relase',compact('relases','name'));

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
        $posts = $posts->orderBy('created_at','desc')->paginate(12);

        return view('katlo_front.posts',compact('posts','name'));

    }

    public function geMedia(Request $request){


        $name='معرض الوسائط';

        if($request->type=='video'){
            $videos=Video::where('active',1) ->orderBy('published_at','desc')->paginate(12);
            return view('katlo_front.video',compact('videos','name'));
        }
        $alboms=Albom::where('active',1)->orderBy('published_at','desc')->paginate(12);

        return view('katlo_front.media',compact('alboms','name'));

    }
    public function show_photo(Albom $albom){

        $name='معرض الوسائط';
        $images=FileLibrary::where('album_id',$albom->id)->orderBy('id','DESC')->paginate(12);
        //$images=$albom->photos;
        return view('katlo_front.photo',compact('images','name','albom'));
    }

    public function getReport(Request $request){

        $name='التقارير';

        $posts = Post::report();
        if($request->sort){
            $posts->orderBy('created_at',$request->sort);
        }
        if($request->search){
            $posts->where('title','LIKE',"%{$request->search}%");
        }
        $posts = $posts->orderBy('created_at','desc')->paginate(12);

        return view('katlo_front.posts',compact('posts','name'));
    }


    public function contactUs(){
        return view('katlo_front.contact_us');
    }
    public function contactUsStore( Request $request){
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

        $mail=new Countact();

        $mail->name=$request->name;
        $mail->email=$request->email;
        $mail->title=$request->news_title;
        $mail->details=$request->details;
        $mail->type='message';
        $mail->sender_ip=getUserIP();
        $mail->date_send=date('Y-m-d');
        $mail->save();
        return redirect()->back()->with('success','تم ارسال رسالتك بنجاح');

    }
    public function add_to_mail(Request $request)
    {

        // dd($request->all());
        $this->validate($request, [
            'email'      => 'required|email'
        ], [], [
            'email'      => 'البريد الإلكتروني'
        ]);

        $old_mail=MailList::where('email',$request->email)->count();
        //  dd($old_mail);
        //
        if($old_mail > 0){
            dd($old_mail);
            $message = 'ايميلك مضاف مسبقا للقائمة البريدية';
            return response()->json(compact('message'));
        }

        $mail=new MailList();
        $mail->email=$request->email;
        $mail->email_ip=getUserIP();
        // dd($mail);
        $mail->save();

        $message = 'تمت اضافتك للقائمة البريدية بنجاح';

        return response()->json(compact('message'));

    }


    public function show_video(Request $request ,Video $video ){
        $name='معرض الوسائط';

        $videos=Video::where('active',1) ->orderBy('published_at','desc')->paginate(12);
        $video_sharing = $video;
        return view('katlo_front.video',compact('videos','video_sharing','name'));

    }

}
