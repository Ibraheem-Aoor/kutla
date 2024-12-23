<?php

namespace App\Models;

use App\Models\Traits\RecordsActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Cases extends Model
{
     protected $table = "cases";
    protected $guarded = [];

    use SoftDeletes;
    use RecordsActivity;

    public function photo(){
        return $this->belongsTo(FileLibrary::class ,'photo_id');
    }
	 public function posts(){
        return $this->hasMany(Post::class ,'case_id');
    }
    public function videos(){
        return $this->hasMany(Video::class ,'case_id');
    }
    public function albums(){
        return $this->hasMany(Albom::class ,'case_id');
    }
}
