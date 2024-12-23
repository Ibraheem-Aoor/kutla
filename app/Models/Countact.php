<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Countact extends Model
{
    protected $table = "mail";
    protected $guarded = [];
    protected $appends = ['created_at_days'];

    use SoftDeletes;

    public function getCreatedAtDaysAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }
 


	
}
