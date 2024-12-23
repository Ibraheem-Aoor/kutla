<?php

namespace App\Models;

use App\Models\Traits\MyDates;
use App\User;
use Illuminate\Database\Eloquent\Model;

class RecorderLogin extends Model
{
    use MyDates;
 protected $table = "recorder_login_users";

    protected $guarded = [];
   
    public function user(){
        return $this->belongsTo(User::class,'user_id');
    }
}
