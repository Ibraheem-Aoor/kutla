<?php

namespace App\Models;

use App\Models\Traits\RecordsActivity;
use App\User;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ReadMorePost extends Model
{
     protected $table = "read_more_posts";
    protected $guarded = [];


    public function post(){
        return $this->belongsTo(Post::class ,'post_id');
    }
 

}
