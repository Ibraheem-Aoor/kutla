<?php

namespace App\Models;

use App\Models\Traits\RecordsActivity;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class LiveVideo extends Model
{
     protected $table = "live_videos";
    protected $guarded = [];
    protected $appends = ['created_at_days'];
    use SoftDeletes;
    use RecordsActivity;

    public function photo(){
        return $this->belongsTo(FileLibrary::class ,'photo_id');
    }
    public function getCreatedAtDaysAttribute()
    {
        return Carbon::parse($this->created_at)->diffForHumans();
    }
}
