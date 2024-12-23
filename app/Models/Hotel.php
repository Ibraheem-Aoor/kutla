<?php

namespace App\Models;


use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    protected $table = "hotels";
    protected $guarded = [];


    public function photo(){
        return $this->belongsTo(FileLibrary::class ,'photo_id');
    }


	
}
