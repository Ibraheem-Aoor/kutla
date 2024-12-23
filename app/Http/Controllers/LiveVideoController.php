<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\LiveVideo;
use App\Models\Tag;
use App\Models\Video;
use Carbon\Carbon;
use Illuminate\Http\Request;
use File;
class LiveVideoController extends Controller
{
    public function index()
    {
        meta('title', 'البث المباشر');

        $breadcrumb = breadcrumbs()
            ->add('الرئيسية','#', 'icon-home')
            ->add(meta('title'));

        meta('breadcrumb', $breadcrumb->render());
        if(in_array('add_video',$this->actions) || in_array('edit_video',$this->actions) || in_array('delete_video',$this->actions) || in_array('view_video',$this->actions)){

            return view('dashboards.live_videos.index');
        }else{
            return view('dashboards.no_permistion');
        }

    }

    public function search()
    {
        $types =  LiveVideo::with('photo');

        if(request()->has('filter')) {
            $filter = request('filter');
            $types = $types->where('name', 'LIKE', "%$filter%");

        }

        if(request()->has('sort')) {
            $sort = json_decode(request('sort'), true);
            $types = $types->orderBy(($sort['fieldName'] ?? 'id'), $sort['order']);
        }

        $types = $types->paginate(15);

        return response()->json(compact('types'));
    }

    public function create()
    {

        meta('title', 'إضافة بث مباشر');

        $breadcrumb = breadcrumbs()
            ->add('الرئيسية','#', 'icon-home')
            ->add('البث المباشر', route('categories.index'))
            ->add(meta('title'));

        meta('breadcrumb', $breadcrumb->render());

        if(in_array('add_video',$this->actions)){

            return view('dashboards.live_videos.form');
        }else{
            return view('dashboards.no_permistion');
        }
    }


    public function uploadVideoFile(Request $request)
    {
//        $request->validate([
//            'file' => 'required',
//        ], [], [
//            'name' => 'ملف الفيديو ',
//        ]);

       // return response($request->file,404);
        if ($request->hasFile('file')) {
           // return response($request->file,404);
            $ext = strtolower($request->file('file')->getClientOriginalExtension());
            $temp = time() . rand(5, 50);
            $newfile = $temp . '.' . $ext;
            $local_path = "/uploads/live_videos/";
            $path = public_path().'/'. $local_path;

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
            'start_at' => 'required',
            'duration' => 'required',
           // 'description' => 'required',
            'youtube_link' => 'required_without_all:video_path,facebook',
            'video_path' => 'required_without_all:youtube_link,facebook',
            'facebook' => 'required_without_all:youtube_link,youtube_link',
            // 'video_type' => 'required',
           // 'tags' => 'required',

        ], [], [
            'name' => 'الاسم ',
            'start_at' => 'وقت البداية',
            'duration' => 'مدة التشغيل',
            'facebook' => 'رابط الفيس بوك',
            //'video_type' => 'النوع',
            'video_path' => 'ملف الفيديو',
            'youtube_link' => ' رابط اليوتيوب',

        ]);

        $start_at = Carbon::parse($request->start_at);
        $end_at=$start_at->addMinutes($request->duration);
        LiveVideo::create([
            'name'=> $request->name,
            'description'=> $request->description,
            'youtube_link'=> $request->youtube_link,
            'file_name'=> $request->video_path,
            'start_at'=> $request->start_at,
            'facebook'=> $request->facebook,
            'end_at'=> $end_at,
            'duration'=> $request->duration,
            'active'=> $request->active,
            'watchNo'=> 0]);


        $message = 'تم الإضافة بنجاح.';

        return response()->json(compact('message'));
    }

    public function edit($id)
    {

        meta('title', ' تعديل فيديو');
        $video=LiveVideo::with('photo')->findOrFail($id);
        $breadcrumb = breadcrumbs()
            ->add('الرئيسية','#', 'icon-home')
            ->add('البث المباشر', route('videos.index'))
            ->add(meta('title'));

        meta('breadcrumb', $breadcrumb->render());

        if(in_array('edit_video',$this->actions)){

            return view('dashboards.live_videos.form',compact('video'));
        }else{
            return view('dashboards.no_permistion');
        }
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required',
            'start_at' => 'required',
            'duration' => 'required',
            'youtube_link' => 'required_without_all:video_path,facebook',
            'video_path' => 'required_without_all:youtube_link,facebook',
            'facebook' => 'required_without_all:youtube_link,youtube_link',
            // 'youtube_link' => 'required',
           // 'description' => 'required',
            // 'video_path' => 'required',
            //'video_type' => 'required',
            //'tags' => 'required',

        ], [], [
            'start_at' => 'وقت البداية',
            'duration' => 'مدة التشغيل',
            'name' => 'الاسم ',
            'category_id' => 'تصنيف الفيديو',
            'photo_id' => 'صورة الفيديو',
            'video_path' => 'ملف الفيديو',
            'youtube_link' => ' رابط اليوتيوب',
            'facebook' => ' رابط الفيس بوك',
            //'description' => 'الوصف',
            //'video_type' => 'النوع',
        ]);
        $video=LiveVideo::findOrFail($id);
        $start_at = Carbon::parse($request->start_at);
        $end_at=$start_at->addMinutes($request->duration);
if($request->video_path){
    $video->update([
        'name'=> $request->name,
        'description'=> $request->description,
        'youtube_link'=> $request->youtube_link,
        'file_name'=> $request->video_path,
        'photo_id'=> $request->photo_id,
        'start_at'=> $request->start_at,
        'facebook'=> $request->facebook,
        'end_at'=> $end_at,
        'duration'=> $request->duration,
        'active'=> $request->active
    ]);

}else{
    $video->update([
        'name'=> $request->name,
        'description'=> $request->description,
        'youtube_link'=> $request->youtube_link,
        'photo_id'=> $request->photo_id,
        'start_at'=> $request->start_at,
        'facebook'=> $request->facebook,
        'end_at'=> $end_at,
        'duration'=> $request->duration,
        'active'=> $request->active
       // 'file_name'=> $request->video_path,
        //'watchNo'=> 0,
    ]);

}



        $message = 'تم الإضافة بنجاح.';

        return response()->json(compact('message'));
    }

    public function delete($id){
        $video=LiveVideo::findOrFail($id);

        if($video->file_name ){
            File::delete(public_path().'/'.$video->file_name);
        }

        $video->delete();

        $message = 'تم الحذف بنجاح.';

        return response()->json(compact('message'));
    }
    public function deleteVideo($id){
        $video=LiveVideo::findOrFail($id);

        if($video->file_name ){
            File::delete(public_path().'/'.$video->file_name);
        }
        $video->file_name=null;
        $video->save();

        $message = 'تم ازالة الفيديو بنجاح.';

        return response()->json(compact('message'));
    }

}
