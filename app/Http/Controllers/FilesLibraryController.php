<?php

namespace App\Http\Controllers;
use App\Models\Category;
use App\Models\FileArchive;
use App\Models\FileLibrary;
use App\Models\Video;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use File;

class FilesLibraryController extends Controller
{


    public function get_images(Request $request)
    {

        $current_view_images =$request->get('current_view_images');
        $openPhotosModal =$request->get('openPhotosModal');
        $photo_name =$request->get('photo_modal_name');
        $photo_type =$request->get('photo_type');
        $has_more=0;
        $results=FileLibrary::where('type','photo');
        $results_se="";
        if(isset($photo_name) && !empty($photo_name)){

            $results_se =$results->where('photo_caption','like','%'.$photo_name.'%');
            $results =$results->where('photo_caption','like','%'.$photo_name.'%');
        }
        if(isset($photo_type) && !empty($photo_type) && $photo_type!='photo'){
    $results_se =$results->where('table_type',$photo_type);
    $results =$results->where('table_type',$photo_type);


        }

        if(!empty($current_view_images) && ($openPhotosModal ==1))
        {
            $results=$results->whereNotIn('id',explode(",",$current_view_images))->orderBy('created_at','desc')->take(10);
        }else {
            $results=$results->orderBy('created_at','desc')->take(18);
        }

        $results_get=$results->get();

        $results_list=$results->pluck("id")->toArray();
        if(!empty($current_view_images) && !empty($results_list) && ($openPhotosModal ==1)){
            $results_ids=array_merge(explode(",",$current_view_images),$results_list);
        }else {
            $results_ids=$results_list;
        }
        if(!empty($results_se)){
            $results_more=$results_se->whereNotIn('id',$results_ids)->orderBy('created_at','desc')->count();
        }else{
            $results_more=FileLibrary::where('type','photo')->whereNotIn('id',$results_ids)->orderBy('created_at','desc')->count();

        }


        if($results_more >0)
        {
            $has_more=1;
        }
        $html_res='';
        foreach($results_get as $one)
        {

            $img_name=explode("/",$one->file_name);
            //return response()->json($img_name,404);
            $img_thumb=$one->thump370;
            $html_res .='<li class="uk-width-medium-1-5 " style="width: 127px;" id="img_upload_'.$one->id.'">'.
                '<div class="uk-panel uk-panel-box">'.
                '<img src="'.asset($img_thumb).'" class="uk-img-responsive" alt="'.$one->real_name.'">'.
                '</div></li>';
        }
        $results_ids=implode(',',$results_ids);

        return response()->json(array('success'=>true,'html_res'=>$html_res,'has_more'=>$has_more,'results_ids'=>$results_ids));
    }


    public function details_files(Request $request){

        $photo_id=$request->get('photo_id');
        $video_id=$request->get('video_id');
        $image_html = '';
        $img_size = null;
        $width = null;
        $height = null;
        $video=null;
        $photo_data=null;
        if($video_id){
         $video=Video::find($video_id);

        }else {
            $photo_data = FileLibrary::find($photo_id);
            if(isset($request->photo_main_desc)){
                if($request->photo_main_desc){
                    $photo_data->photo_caption=$request->photo_main_desc;
                    $photo_data->save();
                }
            }
            if ($photo_data) {
                $created_at = $photo_data->created_at;
                $img_thumb = $photo_data->thump;
                $img_path = $photo_data->file_name;
            }

            if ($request->photo_array) {
                $photo_data = FileLibrary::whereIn('id', $request->photo_array)->get();

                foreach ($photo_data as $photo) {
                    if ($request->modalFromsss == "post_details") {
                        $image_html .= '<div class="article-img-box">
                <img class="img-responsive" src="' . url($photo->thump770) . '" title="' . $photo->photo_caption . '">
               </div><br/>';
                    }
                    if ($request->modalFromsss == "album_images") {
                        $image_html .= '<div class="col-sm-3"  style="margin-top: 10px; width: 130px;" >
                                        <span class="rmove-icon delete_image" id="photo_' . $photo->id . '">
                                                     <img src="/img/remove.png" />
                                                </span>
                                        <img  class="img-responsive" style="height:100px" src="' . asset($photo->thump) . '" alt="choose" >
                                    </div>';

                    }
                }

            }



            if ($request->modalFromsss == '' && file_exists(public_path() . '/' . $img_path)) {
                list($width, $height, $type, $attr) = getimagesize($img_path);
                $img_size = filesize($img_path);
                $img_size = $img_size / 1024;
                if ($img_size >= 1024) {
                    $img_size = round(($img_size / 1024) / 1024, 2) . " MB";
                } else {
                    $img_size = round($img_size, 2) . " KB";
                }
            }
        }

        return  response()->json(array('success'=>true,'video'=>$video,'image_html'=>$image_html,'photo_data'=>$photo_data,'imgWidth'=>$width,'imgHeight'=>$height,'imgSize'=>$img_size));
    }
    public function delete_file($id)
    {
        $file=FileLibrary::find($id);
        if($file){
            $url=base_usrl().'/'.$file->file_url;
            File::delete($url);
            $file->delete();

            $message = 'تم الحذف بنجاح';

            return response()->json(compact('message'));
        }

    }

    public function delete_archive($id)
    {

        $file=FileArchive::find($id);
        if($file){

            $file_path=public_path().$file->file_url;
            File::delete($file_path);
            $file->delete();
            $message = 'تم الحذف بنجاح';

        }
        return  response()->json(array('success'=>true,'message'=>$message));


    }

    public function upload_image(Request $request){
//        $request->validate([
//            'tags' => 'required',
//            'photo_caption' => 'required',
//            'uploaded_img' => 'required',
//
//        ], [], [
//            'tags' => 'Tags ',
//            'photo_caption' => 'عنوان الصورة',
//            'uploaded_img' => 'الصورة',
//
//        ]);


        //save Tags

        $tags=[];


        if($request->water_mark){
            $water_mark=true;
        }else{
            $water_mark=false;
        }
       // dd($request->image->getPathName());
        //$imageSize =empty($_FILES["image"]["tmp_name"])?$_FILES["image"]["name"]:$_FILES["image"]["tmp_name"];
       // dd($_FILES["image"]["tmp_name"],$_FILES["image"]["name"]);
   // dd($imageSize,empty($_FILES["image"]["tmp_name"]));

        $image_data = getimagesize($request->image);
        $image_width = $image_data[0];
        $image_height = $image_data[1];


//        if($image_width < 770 ||$image_height<480){
//            $message='لا يمكن تحميل هذه الصورة لانه مقاسها اقل من المطلوب';
//            return response()->json(array('success'=>false,
//                'message'=>$message,
//                ));
//
//        }


        $image=$request->file('image');
        list($imgWidth,$imgHeight)=getimagesize($image);
        if($request->upload_from=='cases'){
            $file_name = saveBase64Image($request->image, 'images',1300,400,$water_mark);

        }else{
            $file_name = saveBase64Image($request->image, 'images',null,null,$request->image_type,$water_mark);

        }
        $img=new FileLibrary();
        $img->file_name= $file_name;//saveFile($request->image,'images');
        $img->type='photo';
        $img->table_type=$request->upload_from;
        $img->photo_caption=$request->photo_caption;
        $img->save();



        $html_res ="";
        $html_res .='<li class="uk-width-medium-1-5 img-active" style="width: 127px; overflow: hidden;"  id="img_upload_'.$img->id.'">'.
            '<div class="uk-panel uk-panel-box">'.
            '<img src="'.asset($img->thump).'" class="uk-img-responsive" alt="'.$img->photo_caption.'">'.
            '</div></li>';

        return response()->json(array('success'=>true,
            'real_name'=>$img->photo_caption,
            'image_name'=>$img->thump370,
            'photo_id'=>$img->id,
            'html_res'=> $html_res,
            'imgWidth'=> $imgWidth,
            'image_id'=> $request->image_id,
            'imgHeight'=> $imgHeight));

    }

    public function get_videos(Request $request)
    {

        $current_view_videos =$request->get('current_view_videos');
        $openPhotosModal =$request->get('openPhotosModal');
        $video_name =$request->get('video_modal_name');
        $video_cat =$request->get('video_cat');
        $categories=Category::where('type','video')->get();
        $has_more=0;
        $results=Video::with('photo')->whereNotNull('category_id');
        $results_se="";
        if(isset($video_name) && !empty($video_name)){

            $results_se =$results->where('name','like','%'.$video_name.'%');
            $results =$results->where('name','like','%'.$video_name.'%');
        }
        if(isset($video_cat) && !empty($video_cat) && $video_cat!='allcat'){
            $results_se =$results->where('category_id',$video_cat);
            $results =$results->where('category_id',$video_cat);
        }

        if(!empty($current_view_videos) && ($openPhotosModal ==1))
        {
            $results=$results->whereNotIn('id',explode(",",$current_view_videos))->orderBy('created_at','desc')->take(10);
        }else {
            $results=$results->orderBy('created_at','desc')->take(18);
        }

        $results_get=$results->get();

        $results_list=$results->pluck("id")->toArray();
        if(!empty($current_view_videos) && !empty($results_list) && ($openPhotosModal ==1)){
            $results_ids=array_merge(explode(",",$current_view_videos),$results_list);
        }else {
            $results_ids=$results_list;
        }
        if(!empty($results_se)){
            $results_more=$results_se->whereNotIn('id',$results_ids)->orderBy('created_at','desc')->count();
        }else{
            $results_more=Video::whereNotIn('id',$results_ids)->orderBy('created_at','desc')->count();

        }


        if($results_more >0)
        {
            $has_more=1;
        }
        $html_res='';
        foreach($results_get as $one)
        {

if($one->photo){
    $img_thumb='<img src="'.asset($one->photo->thump).'" class="uk-img-responsive" style="width:115px;height:86px">';
}else{
    $img_thumb='<img src="'.asset('img/video.png').'" class="uk-img-responsive" >';
}

            $html_res .='<li class="uk-width-medium-1-5 " style="width: 127px;" id="video_upload_'.$one->id.'">'.
                '<div class="uk-panel uk-panel-box">'.$img_thumb.'<span style=" font-size: 10px;">'.$one->name.'</span></div></li>';
        }
        $x=1;
        $cat='btn-default';
        $category_html='';
        $btn=true;
        foreach ($categories as $category){
            if($video_cat ==$category->id ){
                $cat='btn-info';
                $btn=false;
            }else{
                $cat='btn-default';
            }

            $category_html.=' <button type="button" class="btn '.$cat.' filter_category" id="video_'.$category->id.'">'.$category->name.'</button>';
             $x++;
        }


        if($btn){
            $new_cat='btn-info';

       }else{
           $new_cat='btn-default';
       }
        $category_html.='<button type="button" class="btn '.$new_cat.' filter_category" id="all_allcat">الكل</button>';

        $results_ids=implode(',',$results_ids);

        return response()->json(array('success'=>true,'html_res'=>$html_res,'category_html'=>$category_html,'has_more'=>$has_more,'results_ids'=>$results_ids));
    }

    public function upload_files(Request $request){
                $request->validate([
            'file' => 'required|mimes:doc,docx,xls,xlsx,zip,pdf,txt,xlsx',
        ], [], [
            'file' => 'يجب ان يكون ملف وورد او اكسل او pdf اوzip ',


        ]);



        if ($request->hasFile('file')) {
            // return response($request->file,404);
            $ext = strtolower($request->file('file')->getClientOriginalExtension());
            $file_old_name = strtolower($request->file('file')->getClientOriginalName());

            $temp = time() . rand(5, 50);
            $newfile = $temp . '.' . $ext;
            $local_path = "/uploads/files/";
            $path = public_path().'/'. $local_path;

            if (!File::exists($path)) {
                File::makeDirectory($path, $mode = 0777, true, true);
            }

            $uploaded = $request->file('file')->move($path, $newfile);
            $full_path = $local_path . $newfile;
            $img=new FileArchive();
            $img->file_name=$file_old_name;
            $img->file_url=$full_path;
            $img->type=$ext;
            $img->table_type=$request->upload_from;
            $img->save();
        }





        $html_res ="";
$image_file=asset('img/'.$img->type.'.png');

        $html_res .='<li class="uk-width-medium-1-5 " style="width: 127px;" id="file_upload_'.$img->id.'"><span  class="rmove-icon"><img src="'.asset('img/remove.png').'" /></span>'.
            '<div class="uk-panel uk-panel-box"><img src="'.$image_file.'" class="uk-img-responsive" style="width:115px;height:86px"><span style=" font-size: 10px;">'.$img->file_name.'</span></div></li>';

        return response()->json(array('success'=>true,
            'image_name'=>$image_file,
            'photo_id'=>$img->id,
            'html_res'=> $html_res,
            'image_id'=> $request->image_id,
            ));

    }

    public function get_archive_files(Request $request)
    {

        $current_view_archive =$request->get('current_view_archive');
        $archive_name =$request->get('archive_modal_name');
        $has_more=0;
        $results=FileArchive::whereNotNull('type');
        $results_se="";
        if(isset($archive_name) && !empty($archive_name)){
            $results_se =$results->where('file_name','like','%'.$archive_name.'%');
        }


        if(!empty($current_view_archive))
        {
            $results=$results->whereNotIn('id',explode(",",$current_view_archive))->orderBy('created_at','desc')->take(14);
        }else {
            $results=$results->orderBy('created_at','desc')->take(21);
        }

        $results_get=$results->get();

        $results_list=$results->pluck("id")->toArray();
        if(!empty($current_view_archive) && !empty($results_list) ){
            $results_ids=array_merge(explode(",",$current_view_archive),$results_list);
        }else {
            $results_ids=$results_list;
        }
        if(!empty($results_se)){
            $results_more=$results_se->whereNotIn('id',$results_ids)->orderBy('created_at','desc')->count();
        }else{
            $results_more=FileArchive::whereNotIn('id',$results_ids)->orderBy('created_at','desc')->count();

        }


        if($results_more >0)
        {
            $has_more=1;
        }
        $html_res='';
        foreach($results_get as $one)
        {
            $image_file=asset('img/'.$one->type.'.png');

                $img_thumb='<img src="'.$image_file.'" class="uk-img-responsive" style="height:86px">';


            $html_res .='<div id="arc-file_'.$one->id.'" style="height: 150px;
    width: 130px;"><li class="uk-width-medium-1-5 " style="width: 127px;" id="ar_upload_'.$one->id.'">'.
                '<div class="uk-panel uk-panel-box" style="background-color: unset;">'.$img_thumb.'<span style=" font-size: 8px;">'.$one->file_name.'</span>
</div></li><button type="button" class="md-btn md-btn-flat-danger md-btn-wave waves-effect waves-button remove_file" id="file_ar_'.$one->id.'"> حذف </button></div>';
        }





        $results_ids=implode(',',$results_ids);

        return response()->json(array('success'=>true,'html_res'=>$html_res,'has_more'=>$has_more,'results_ids'=>$results_ids));
    }

    public function details_archive(Request $request){

        $file_id=$request->get('file_id');


            $photo_data = FileArchive::find($file_id);

                        $image_html = '<a href="'.url($photo_data->file_url).'">'.$photo_data->file_name.'</a>';



        return  response()->json(array('success'=>true,'image_html'=>$image_html));
    }

    //This Code Add By Moman Albelbesi
    public function saveNameOfFile(Request $request){
        $photo_Caption = FileLibrary::find($request->file_id);
        $photo_Caption->photo_caption=$request->post_photo_caption;
        $photo_Caption->save();

        return ['success'=>true];
    }
    // End This Function

}