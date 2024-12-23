<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostAlbumPhoto extends Model
{
     protected $table = "posts_albums_photos";
    protected $guarded = [];

    public function photo(){
        return $this->belongsTo(FileLibrary::class ,'photo_id');
    }
    
}
