<?php

namespace App\Models;

use App\Models\Traits\RecordsActivity;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Writer extends Model
{
     protected $table = "writers";
    protected $guarded = [];
    protected $appends = ['created_at_days'];

    use SoftDeletes;
    use RecordsActivity;

    public function Category(){
        return $this->belongsTo(Category::class ,'category_id');
    }

    public function Country(){
        return $this->belongsTo(Country::class ,'country_id');
    }
    public function photo(){
        return $this->belongsTo(FileLibrary::class ,'photo_id');
    }
    public function Posts(){
        return $this->hasMany(Post::class ,'writer_id');
    }
    public function getCreatedAtDaysAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }
}
