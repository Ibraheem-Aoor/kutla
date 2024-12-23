<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NewAddress extends Model
{
	protected $connection = 'mysql2';
     protected $table = "address";
	 
    protected $guarded = [];

   
}
