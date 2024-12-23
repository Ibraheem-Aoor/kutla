<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class MailSent extends Model
{
     protected $table = "send_to_mail";
    protected $guarded = [];

    public function post_sent(){
        return $this->hasMany(MailListPost::class,'send_to_mail_id');
    }
   
   
}
