<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class VoteAnswerResult extends Model
{
     protected $table = "vote_answers_results";
    protected $guarded = [];

    public function vote(){
        return $this->belongsTo(Vote::class ,'vote_id');
    }
    public function vote_answer(){
        return $this->belongsTo(VoteAnswer::class ,'vote_answer_id');
    }
}
