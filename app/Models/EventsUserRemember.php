<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class EventsUserRemember extends Model
{
     protected $table = "events_users_remember";
    protected $guarded = [];

    
	 public function user(){
        return $this->belongsTo(User::class ,'user_id');
    }
    public function event(){
        return $this->belongsTo(Events::class ,'event_id');
    }
   
}
