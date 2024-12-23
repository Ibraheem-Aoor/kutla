<?php

namespace App\Models\Traits;

use App\Models\UserLog;
use Carbon\Carbon;

trait RecordsActivity
{
    protected static function bootRecordsActivity()
    {
        foreach(static::getModelEvents() as $event) {
            static::$event(function($model) use ($event) {
                $model->recordActivity($event);
            });
        }

    }

    public function recordActivity($event)
    {
        if(auth()->check()) {
            UserLog::create([
                'logable_id' => $this->id,
                'logable_type' => (new \ReflectionClass($this))->getName(),
                'event' => $this->getActivityName($event),
                'record_old' => json_encode($this->getOriginal()),
                'record_new' => json_encode($this->getAttributes()),
                'user_id' => auth()->user()->id,
                'user_ip' => client_ip(),
                'time' => Carbon::now()
            ]);
        }

    }

    protected function getActivityName($action)
    {

        return "{$action}";
    }

    protected static function getModelEvents()
    {
        if(isset(static::$recordEvents)) {
            return static::$recordEvents;
        }

        return ['created', 'deleted', 'updated'];
    }
}