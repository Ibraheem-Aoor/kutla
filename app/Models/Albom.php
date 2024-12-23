<?php

namespace App\Models;

use App\Models\Traits\RecordsActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Albom extends Model
{
     protected $table = "albums";
    protected $guarded = [];
    protected $appends = ['big_cover','cover',''];
    use SoftDeletes;
    use RecordsActivity;

    public function getCoverAttribute()
    {
        if($this->photos()->count()){
            $cover= $this->photos()->first()->thump370;

        }else{
            $cover=asset('/').'img/default.jpg';
        }
        return $cover;
    }
    public function getImageUrlAttribute()
    {
        if($this->photos()->count()){
            $cover= $this->photos()->first()->file_name;

        }else{
            $cover=asset('/').'img/default.jpg';
        }
        return $cover;
    }
    public function getBigCoverAttribute()
    {
        if($this->photos()->count()){
            $cover= $this->photos()->first()->file_name;

        }else{
            $cover=asset('/').'img/default.jpg';
        }
        return $cover;
    }


    public function photos(){
        return $this->hasMany(FileLibrary::Class,'album_id')->orderBy('id','DESC');
    }

    public function category(){
        return $this->belongsTo(Category::Class,'category_id');
    }
    public function photoscover(){
        return $this->hasOne(FileLibrary::class,'album_id')->where('album_cover',1);
    }
    public function cases(){
        return $this->belongsTo(Cases::Class,'case_id');
    }
}
