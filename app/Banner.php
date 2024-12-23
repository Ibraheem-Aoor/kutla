<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\FileLibrary;
class Banner extends Model
{
    protected $guarded = [];
    protected $appends=['image_first','image_second','gif_url'];
    public function getImageFirstAttribute(){
        return asset($this->photo->file_name);
    }
    public function getImageSecondAttribute(){
        return asset($this->photo2->file_name);
    }

     public function getGifUrlAttribute(){

        return $this->gif_image?asset($this->gif_image):null;
    }
    public function photo(){
        return $this->belongsTo(FileLibrary::class ,'photo_id');
    }

    public function photo2(){
        return $this->belongsTo(FileLibrary::class ,'photo2_id');
    }
}
