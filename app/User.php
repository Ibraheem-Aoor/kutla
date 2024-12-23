<?php

namespace App;

use App\Models\Client;
use App\Models\Role;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    protected $guarded = [];
    protected $appends = ['thump'];
    protected $hidden = [
        'password', 'remember_token',
    ];
    public function getThumpAttribute()
    {

        $thumb=explode('/',$this->photo);
        array_splice($thumb, 2, 0, 'thump_120');

        return implode('/',$thumb);
    }

    public function getImageAttribute()
    {
        if($this->photo){
            return asset($this->thump);
        }else{
            return "https://www.gravatar.com/avatar/" . md5( strtolower( trim( $this->email ) ) ) . "?s=80";;

        }
    }

    public function Role()
    {
        return $this->belongsTo(Role::class,   'role_id');
    }


}
