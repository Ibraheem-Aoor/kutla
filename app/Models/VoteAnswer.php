<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VoteAnswer extends Model
{
     protected $table = "vote_answers";
    protected $guarded = [];
    use SoftDeletes;

    public function vote(){
        return $this->belongsTo(Vote::class ,'vote_id');
    }
    public function photo(){
        return $this->belongsTo(FileLibrary::class ,'photo_id');
    }
}
