<?php

namespace App\Models;

use App\Models\Traits\RecordsActivity;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class PostReaction extends Model
{
     protected $table = "post_reaction";
    protected $guarded = [];


    public function post(){
        return $this->belongsTo(Post::class ,'post_id');
    }
    public function main_post(){
        return $this->belongsTo(MainPost::class ,'post_id','post_id');
    }

}
