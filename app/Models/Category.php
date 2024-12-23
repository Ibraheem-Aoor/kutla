<?php

namespace App\Models;

use App\Models\Traits\RecordsActivity;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Category extends Model
{
     protected $table = "categories";
    protected $guarded = [];
    use SoftDeletes;
    use RecordsActivity;

    public function Position(){
        return $this->belongsTo(PostPosition::class ,'position');
    }
    public function posts(){
        return $this->hasMany(Post::class,'category_id');
    }

}
