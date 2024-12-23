<?php

namespace App\Models;

use App\Models\Traits\RecordsActivity;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Vote extends Model
{
    protected $table = "votes";
    protected $guarded = [];
    protected $appends = ['created_at_days'];

    use SoftDeletes;
    use RecordsActivity;

    public function photo(){
        return $this->belongsTo(FileLibrary::class ,'photo_id');
    }
    public function Category(){
        return $this->belongsTo(Category::class ,'category_id');
    }
    public function answers(){
        return $this->hasMany(VoteAnswer::class ,'vote_id');
    }
    public function getCreatedAtDaysAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }


	
}
