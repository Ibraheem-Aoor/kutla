<?php

namespace App\Http\Controllers;

use App\Models\Cases;
use App\Models\Category;
use App\Models\Tag;
use App\Models\Video;
use Illuminate\Http\Request;
use File;
use DB;
class VideoController extends Controller
{
    public function index()
    {
        meta('title', 'الفيديوهات');

        $breadcrumb = breadcrumbs()
            ->add('الرئيسية','#', 'icon-home')
            ->add(meta('title'));

        meta('breadcrumb', $breadcrumb->render());
        if(in_array('add_video',$this->actions) || in_array('edit_video',$this->actions) || in_array('delete_video',$this->actions) || in_array('view_video',$this->actions)){
            $categories=Category::where('type','video')->get();
            return view('dashboards.videos.index',compact('categories'));
        }else{
            return view('dashboards.no_permistion');
        }

    }

    public function search()
    {
        $filter = json_decode(request('filter'));

        $types =  Video::with('category','cases')->where(function ($query) use ($filter) {
            if ($filter->title) {
                $query->where('name', 'like', "%$filter->title%");
            }
            if (isset($filter->start_date) && isset($filter->end_date)) {
                if ($filter->start_date && $filter->end_date) {

                    $published_at = date('Y-m-d H:i:s', strtotime($filter->start_date));
                    $published_to = date('Y-m-d H:i:s', strtotime($filter->end_date));
                    $query->whereBetween('created_at', [$published_at, $published_to]);

                }
            }
            if ($filter->category_id) {
                $query->where('category_id', $filter->category_id);
            }
            });
            if(\request('cases')!='null'){
                $types->where('case_id',\request('cases'));
            }


//        if(request()->has('sort')) {
//            $sort = json_decode(request('sort'), true);
//            $types = $types->orderBy(($sort['fieldName'] ?? 'id'), $sort['order']);
//        }

        $types = $types->orderBy('id','desc')->paginate(15);


        return response()->json(compact('types'));
    }

    public function create()
    {

        meta('title', 'إضافة فيديو');

        $breadcrumb = breadcrumbs()
            ->add('الرئيسية','#', 'icon-home')
            ->add('الفيديوهات', route('videos.index'))
            ->add(meta('title'));

        meta('breadcrumb', $breadcrumb->render());
        $cases = Cases::get();
        if(in_array('add_video',$this->actions)){

            return view('dashboards.videos.form',compact('cases'));
        }else{
            return view('dashboards.no_permistion');
        }
    }

    public function getAlbomCat(){
        $cat=Category::where('type','video')->get();

        return response()->json($cat);
    }

    public function uploadVideoFile(Request $request)
    {
         $request->validate([
            'file' => 'required|mimes:m4v,avi,flv,mp4,mov',
        ], [], [
            'name' => 'ملف الفيديو ',
        ]);


       // return response($request->file,404);
        if ($request->hasFile('file')) {
           // return response($request->file,404);
            $ext = strtolower($request->file('file')->getClientOriginalExtension());
            $temp = time() . rand(5, 50);
            $newfile = $temp . '.' . $ext;
            $local_path = "/uploads/videos/";
            $path = my_public(). $local_path;

            if (!File::exists($path)) {
                File::makeDirectory($path, $mode = 0777, true, true);
            }

            $uploaded = $request->file('file')->move($path, $newfile);
            $full_path = $local_path . $newfile;

            $status=true;
            $message = 'تم الرفع بنجاح';
            return response()->json(compact('message',  'full_path','status'),200);
        } else {
            $message = 'خطأ في الرفع';
            return response()->json(compact('message'), 404);
        }

    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'photo_id' => 'required',
           // 'description' => 'required',
            'youtube_link' => 'required_without:video_path',
            'video_path' => 'required_without:youtube_link',

            // 'video_type' => 'required',
           // 'tags' => 'required',

        ], [], [
            'name' => 'الاسم ',
            'category_id' => 'تصنيف الفيديو',
            'photo_id' => 'صورة الفيديو',
            //'video_type' => 'النوع',
            'video_path' => 'ملف الفيديو',
            'youtube_link' => ' رابط اليوتيوب',

        ]);
        $tag_arr=[];
        $tag_arr=$request->tags;
        $tag_data=[];
        if ($request->tags) {
            foreach ($tag_arr as $tag) {
                if (isset($tag['text'])) {
                    $old_tag = Tag::where('name', $tag['text'])->first();
                    $tag_data[] = $tag['text'];
                    if (!$old_tag && $tag) {
                        $old_tag = new Tag();
                        $old_tag->name = $tag['text'];
                        $old_tag->save();
                    }

                }
            }
        }


        if($tag_data){
            $tag_new=implode(',',$tag_data);

        }else{
            $tag_new=null;
        }
        if($request->main){
            $array_update = array('main' => 0);
            DB::table('videos')
                ->update($array_update);
        }
        $publish_at = date("Y-m-d H:i:s", strtotime($request->publish_at));

        Video::create([
            'name'=> $request->name,
            'category_id'=> $request->category_id,
            'description'=> $request->description,
            'youtube_link'=> $request->youtube_link,
            'file_name'=> $request->video_path,
            'photo_id'=> $request->photo_id,
            'active'=> $request->active,
            'main'=> $request->main,
            'case_id' => $request->case_id,
            'watchNo'=> 0,
            'tags'=> $tag_new,
            'published_at'=>$publish_at
        ]);

//save Tags

        $message = 'تم الإضافة بنجاح.';

        return response()->json(compact('message'));
    }

    public function edit($id)
    {

        meta('title', ' تعديل فيديو');
        $video=Video::with('photo','cases')->findOrFail($id);
        $breadcrumb = breadcrumbs()
            ->add('الرئيسية','#', 'icon-home')
            ->add('الفيديوهات', route('videos.index'))
            ->add(meta('title'));
        $cases = Cases::get();
        meta('breadcrumb', $breadcrumb->render());

        if(in_array('edit_video',$this->actions)){

            return view('dashboards.videos.form',compact('video','cases'));
        }else{
            return view('dashboards.no_permistion');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'category_id' => 'required',
            'photo_id' => 'required',
            'youtube_link' => 'required_without:video_path',
            'video_path' => 'required_without:youtube_link',
            // 'youtube_link' => 'required',
           // 'description' => 'required',
            // 'video_path' => 'required',
            //'video_type' => 'required',
            //'tags' => 'required',

        ], [], [
            'name' => 'الاسم ',
            'category_id' => 'تصنيف الفيديو',
            'photo_id' => 'صورة الفيديو',
            'video_path' => 'ملف الفيديو',
            'youtube_link' => ' رابط اليوتيوب',
            //'description' => 'الوصف',
            //'video_type' => 'النوع',
        ]);
        if($request->main){
            $array_update = array('main' => 0);
            DB::table('videos')
                ->update($array_update);
        }
        $video=Video::findOrFail($id);
        $tag_arr=[];
        $tag_arr=$request->tags;
        $tag_data=[];
        if ($request->tags) {
            foreach ($tag_arr as $tag) {
                if (isset($tag['text'])) {
                    $old_tag = Tag::where('name', $tag['text'])->first();
                    $tag_data[] = $tag['text'];
                    if (!$old_tag && $tag) {
                        $old_tag = new Tag();
                        $old_tag->name = $tag['text'];
                        $old_tag->save();
                    }

                }
            }
        }


        if($tag_data){
            $tag_new=implode(',',$tag_data);

        }else{
            $tag_new=null;
        }
        $publish_at = date("Y-m-d H:i:s", strtotime($request->publish_at));

        if($request->video_path){
    $video->update([
        'name'=> $request->name,
        'category_id'=> $request->category_id,
        'description'=> $request->description,
        'youtube_link'=> $request->youtube_link,
        'file_name'=> $request->video_path,
        'photo_id'=> $request->photo_id,
        'active'=> $request->active,
        'case_id' => $request->case_id,
        'main'=> $request->main,
        //'watchNo'=> 0,
        'tags'=> $tag_new,
        'published_at'=>$publish_at
    ]);

}else{
    $video->update([
        'name'=> $request->name,
        'category_id'=> $request->category_id,
        'description'=> $request->description,
        'youtube_link'=> $request->youtube_link,
        'photo_id'=> $request->photo_id,
        'case_id' => $request->case_id,
        'main'=> $request->main,
        // 'file_name'=> $request->video_path,
        //'watchNo'=> 0,
        'tags'=> $tag_new,
        'published_at'=>$publish_at
    ]);

}

//save Tags
        foreach ($request->tags as $tag){
            if(Tag::where('name',$tag)){
                $t=new Tag();
                $t->name=$tag;
                $t->save();
            }
        }

        $message = 'تم الإضافة بنجاح.';

        return response()->json(compact('message'));
    }

    public function delete($id){
        $video=Video::findOrFail($id);

        if($video->file_name ){
            File::delete(public_path().'/'.$video->file_name);
        }

        $video->delete();

        $message = 'تم الحذف بنجاح.';

        return response()->json(compact('message'));
    }
    public function deleteVideo($id){
        $video=Video::findOrFail($id);

        if($video->file_name ){
            File::delete(public_path().'/'.$video->file_name);
        }
        $video->file_name=null;
        $video->save();

        $message = 'تم ازالة الفيديو بنجاح.';

        return response()->json(compact('message'));
    }
    public function video_case($case = null)
    {
        $cases = Cases::find($case);

        meta('title', 'المنشورات');
        if ($case == null) {
            $breadcrumb = breadcrumbs()
                ->add('الفيديوهات', '#', 'icon-home')
                ->add(meta('title'));
        } else {
            $breadcrumb = breadcrumbs()
                ->add('الفيديوهات', route('videos.index'), 'icon-home')
                ->add('الملفات الخاصة', route('cases.index'))
                ->add($cases->name);
        }


        meta('breadcrumb', $breadcrumb->render());
        if (in_array('add_video', $this->actions) || in_array('edit_video', $this->actions) || in_array('delete_video', $this->actions) || in_array('view_video', $this->actions)) {
            $categories=Category::where('type','video')->get();

            return view('dashboards.videos.index', compact('cases','categories'));
        } else {
            return view('dashboards.no_permistion');
        }
    }

}
