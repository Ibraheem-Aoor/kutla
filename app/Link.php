<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Models\FileLibrary;
class Link extends Model
{
    protected $guarded = [];
    protected $appends=['image_url'];
    public function getImageUrlAttribute(){
        return asset($this->photo->file_name);
    }


    public function photo(){
        return $this->belongsTo(FileLibrary::class ,'photo_id');
    }
}
