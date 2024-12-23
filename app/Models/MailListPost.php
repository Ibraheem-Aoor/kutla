<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MailListPost extends Model
{
     protected $table = "mail_list_posts";
    protected $guarded = [];

    public function post(){
        return $this->belongsTo(Post::class,'post_id');
    }
}
