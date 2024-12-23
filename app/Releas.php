<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\FileLibrary;
class Releas extends Model
{
    protected $guarded=[];
//    protected $appends=['image_url'];
    public function getImageUrlAttribute(){
        return asset('image/'.$this->photo);
    }

    public function photo(){
        return $this->belongsTo(FileLibrary::class ,'photo_id');
    }

}
