<?php

namespace App\Models;

use App\Models\Traits\RecordsActivity;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Video extends Model
{
     protected $table = "videos";
    protected $guarded = [];
    protected $appends = ['type','created_at_days','video_link'];//,'image_url'
    use SoftDeletes;
    use RecordsActivity;


    public function category(){
        return $this->belongsTo(Category::Class,'category_id');
    }
    public function getVideoLinkAttribute(){
        if($this->file_name){

            return asset($this->file_name);
        }else{

            return $this->youtube_link;
        }

    }
    public function getImageUrlAttribute(){
        if($this->photo()->count()){
            return asset($this->photo->thump770);
        }else{

            $cover=asset('/').'img/default.jpg';
            return $cover;
         }

    }


    public function getTypeAttribute()
    {
        if($this->file_name){
            return 'file';
        }elseif ($this->youtube_link){
            return 'youtube';
        }else{
            return null ;
        }
    }
    public function photo(){
        return $this->belongsTo(FileLibrary::class ,'photo_id');
    }
    public function getCreatedAtDaysAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }

    public function cases(){
        return $this->belongsTo(Cases::Class,'case_id');
    }
}
