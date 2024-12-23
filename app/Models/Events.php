<?php

namespace App\Models;

use App\Models\Traits\RecordsActivity;
use Illuminate\Database\Eloquent\Model;

class Events extends Model
{
     protected $table = "events";
    protected $guarded = [];

    use RecordsActivity;
    
	 public function users_events(){
        return $this->hasMany(EventsUserRemember::class ,'event_id');
    }

    public function users_events_auth(){
        return $this->hasMany(EventsUserRemember::class ,'event_id')->where('user_id',auth()->user()->id)->where('remember',0)
            ->where(function ($ss){
                $ss->whereNull('remind_later')->orWhere('remind_later','<',date('Y-m-d H:i:s'));
            });
    }
    public function users_events_user(){
        return $this->hasMany(EventsUserRemember::class ,'event_id')->where('user_id',auth()->user()->id);
    }
   
}
