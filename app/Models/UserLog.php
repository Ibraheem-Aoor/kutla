<?php

namespace App\Models;

use App\Models\Traits\MyDates;
use App\User;
use Illuminate\Database\Eloquent\Model;

class UserLog extends Model
{
    use MyDates;

    protected $guarded = [];
    public $timestamps = false;

    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
