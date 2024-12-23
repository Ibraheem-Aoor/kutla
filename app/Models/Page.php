<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Page extends Model
{
     protected $table = "pages";
    protected $guarded = [];

    public function photo(){
        return $this->belongsTo(FileLibrary::class ,'photo_id');
    }
}
