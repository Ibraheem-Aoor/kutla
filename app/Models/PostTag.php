<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PostTag extends Model
{
     protected $table = "post_tags";
    protected $guarded = [];
    protected $appends = [];

    public function tag(){
        return $this->belongsTo(Tag::class,'tag_id');
    }

}
