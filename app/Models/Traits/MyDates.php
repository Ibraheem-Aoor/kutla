<?php

namespace App\Models\Traits;

use Carbon\Carbon;

trait MyDates
{
    public function getCreatedAtAttribute($value)
    {
        $car = Carbon::createFromTimestamp(strtotime($this->attributes['created_at']))
            ->timezone('Asia/Riyadh')->format('Y-m-d H:i:s');

        $time = strtotime($car);
        $date = date('Y-m-d H:i:s',$time);

        return $date;
    }

    public function getUpdatedAtAttribute($value)
    {
        $car = Carbon::createFromTimestamp(strtotime($this->attributes['updated_at']))
            ->timezone('Asia/Riyadh')->format('Y-m-d H:i:s');

        $time = strtotime($car);
        $date = date('Y-m-d H:i:s',$time);

        return $date;
    }
}