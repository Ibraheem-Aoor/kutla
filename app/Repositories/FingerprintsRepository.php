<?php

namespace App\Repositories;

use App\Helpers\Fingerprints;
use App\Models\AttendanceLog;
use App\Models\AttendanceLogArchive;
use App\Models\Device;
use App\Models\Employee;
use Carbon\Carbon;
use DB;

/**
 * Class FingerprintsRepository
 * @package App\Repositories
 */
class FingerprintsRepository
{
    /**
     * @var
     */
    protected $device;

    /**
     * FingerprintsRepository constructor.
     * @param Device $device
     */
    public function __construct(Device $device)
    {
        $this->device = $device;

        set_time_limit(0);
    }

    /**
     * Store new employees and update current employees.
     */
    public function storeEmployees()
    {
        $employees = Fingerprints::getEmployees($this->device->ip, $this->device->port);

        $employees = collect($employees)->map(function($e){
            return [
                'UserName' => $e['UserName'],
                'UserID' => $e['UserID'],
                'user_id' => $this->device->client->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        })->toArray();

        $employees = array_to_sql_values($employees);

        $employeesTable = (new Employee)->getTable();

        DB::statement("INSERT INTO `$employeesTable` (`name`, `fingerprint_id`, `user_id`, `created_at`, `updated_at`) 
          VALUES $employees ON DUPLICATE KEY UPDATE `updated_at` = VALUES(`updated_at`);");

    }

    /**
     * Store the employees attendance logs.
     */
    public function storeAttendanceLogs()
    {
        $logs = Fingerprints::getAttendanceLogs($this->device->ip, $this->device->port);
            $device=Device::find($this->device->id);
            $device->records_count=count($logs);
            $device->save();
        $lastLog = AttendanceLogArchive::where('device_id', $this->device->id)
            ->orderBy('date', 'DESC')->first();

        $logs = collect($logs)->filter(function($q) use($lastLog){
            if($lastLog) {
                return Carbon::create($q['Year'], $q['Month'], $q['Day'], $q['Hour'], $q['Minute'], $q['Second'])->greaterThan(Carbon::parse($lastLog->date));
            }
            return true;
        })->map(function($l){
            return [
                'employee_fingerprint_id' => $l['UserID'],
                'status' => $l['InOutMode'] ? 'out' : 'in',
                'date' => Carbon::create($l['Year'], $l['Month'], $l['Day'], $l['Hour'], $l['Minute'], $l['Second']),
                'device_id' => $this->device->id,
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ];
        })->toArray();

        DB::table((new AttendanceLog)->getTable())->insert($logs);
    }

    /**
     * Get employees attendance logs between two dates.
     *
     * @param Carbon $from
     * @param Carbon $to
     * @return mixed
     */
    public function getAttendanceLogsFromDeviceBetween(Carbon $from = null, Carbon $to = null)
    {
        $logs = Fingerprints::getAttendanceLogs($this->device->ip, $this->device->port);

        $from = $from ?? Carbon::now()->firstOfMonth();
        $to = $to ?? Carbon::now()->lastOfMonth();

        return collect($logs)->filter(function($log) use($from, $to){
            $date = Carbon::create($log['Year'], $log['Month'], $log['Day'], $log['Hour'], $log['Minute'], $log['Second']);
            return $date->between($from, $to);
        });
    }
}