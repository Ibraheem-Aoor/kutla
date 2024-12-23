<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Tag extends Model
{
     protected $table = "tags";
    protected $guarded = [];
    protected $appends = [];
    use SoftDeletes;


    public function post()
    {
        return $this->belongsToMany(Post::class,'post_tags');
    }



}
