<?php

namespace App\Models;

use App\Models\Traits\RecordsActivity;
use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
     protected $table = "roles";
    protected $guarded = [];
    protected $appends = [];
    use RecordsActivity;


}
