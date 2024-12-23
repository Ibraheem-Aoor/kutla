<?php

namespace App\Models;

use App\Models\Traits\RecordsActivity;
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Urgent extends Model
{
    protected $table = "urgents";
    protected $guarded = [];

    use SoftDeletes;
    use RecordsActivity;


    public function Category(){
        return $this->belongsTo(Category::class ,'category_id');
    }
 


	
}
