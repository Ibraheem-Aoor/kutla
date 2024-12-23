<?php

namespace App\Helpers;


use App\Models\AttendanceLog;
use App\Models\AttendanceLogArchive;
use App\Models\Device;
use DB;
use Carbon\Carbon;
use GuzzleHttp\Client;
use App\Models\Employee;
use GuzzleHttp\Psr7\Request;
use App\Models\EmployeesActivity;
use Illuminate\Support\Facades\Log;

class Fingerprints
{
    /**
     * Fingerprints constructor.
     */
    public function __construct()
    {
        set_time_limit(0);
    }

    /**
     * Check if the device is connected.
     *
     * @param $ip
     * @param $port
     * @return bool
     */
//    public static function check($ip, $port): bool
//    {
//        try {
//            $uri = config('fingerprint.ip') . "/api/TimeAttendanceService";
//
//            $client = new Client();
//
//            $request = new Request(
//                "POST",
//                $uri,
//                ["Content-Type" => "application/x-www-form-urlencoded; charset=utf-8"],
//                "IPAddress={$ip}&Port={$port}&Token=");
//
//            $response = $client->send($request);
//
//            $body = $response->getBody();
//
//            if($body->getContents() == "true") {
//                return true;
//            }
//
//        } catch(\Exception $exception) {}
//
//        return false;
//    }
//    public static function getDeviceDatetime($ip, $port)
//    {
//
//
//        $client = new Client();
//        $request = new Request(
//            "POST",
//            config('fingerprint.ip') . "/api/TimeAttendanceService/GetDeviceDateTime",
//            ["Content-Type" => "application/x-www-form-urlencoded; charset=utf-8"],
//            "IPAddress={$ip}&Port={$port}&Token=");
//
//        $response = $client->send($request);
//
//        $body = $response->getBody();
//
//        return json_decode($body->getContents(), true);
//    }
//    public static function setDeviceDatetime($ip, $port,$datetime)
//    {
//
//
//        $client = new Client();
//        $request = new Request(
//            "POST",
//            config('fingerprint.ip') . "/api/TimeAttendanceService/SetDeviceDateTime",
//            ["Content-Type" => "application/x-www-form-urlencoded; charset=utf-8"],
//            "IPAddress={$ip}&Port={$port}&DateTime={$datetime}&Token=");
//
//        $response = $client->send($request);
//
//        $body = $response->getBody();
//
//        return json_decode($body->getContents(), true);
//    }

    /**
     * Get All users on device.
     *
     * @param $ip
     * @param $port
     * @return mixed
     */


    public static function getEmployees($ip, $port)
    {
        $client = new Client();

        $request = new Request(
            "POST",
            config('fingerprint.ip') . "/api/TimeAttendanceService/GetAllUserInfo",
            ["Content-Type" => "application/x-www-form-urlencoded; charset=utf-8"],
            "IPAddress={$ip}&Port={$port}&Token=");

        $response = $client->send($request);

        $body = $response->getBody();

        return json_decode($body->getContents(), true);
    }

    /**
     * Get All Attendance Logs
     *
     * @param $ip
     * @param $port
     * @return mixed
     */
//    public static function getAttendanceLogs($ip, $port)
//    {
//        $client = new Client();
//        Log::info("IP: {$ip}:{$port}");
//        $request = new Request(
//            "POST",
//            config('fingerprint.ip') . "/api/TimeAttendanceService/GetAllAttendanceLogs",
//            ["Content-Type" => "application/x-www-form-urlencoded; charset=utf-8"],
//            "IPAddress={$ip}&Port={$port}&Token=");
//
//        $response = $client->send($request);
//
//        $body = $response->getBody();
//
//        return json_decode($body->getContents(), true);
//    }

    /**
     * Calculate employees attendance activities.
     *
     * @param Device $device
     */
//    public static function calculateEmployeesActivity(Device $device)
//    {
//        $employees = Employee::with('shift', 'attendanceLogs', 'client')
//            //->where('device_id', $device->id)
//            ->get();
//
//        $Y = date('Y');
//        $m = date('m');
//        $d = date('d');
//
//        $activities = [];
//        $done = [];
//
//        foreach ($employees as $employee) {
//
//            if(!$employee->shift) { continue; }
//
//            $days = collect($employee->attendanceLogs)->groupBy(function($log) {
//                return Carbon::parse($log->date)->format('Y-m-d');
//            });
//
//            $shiftStart = Carbon::parse($employee->shift->start_at);
//            $shiftEnd = Carbon::parse($employee->shift->end_at);
//
//            if($employee->shift->break) {
//                $shiftBreakStart = Carbon::parse($employee->shift->break_start_at)->setDate($Y, $m, $d);
//                $shiftBreakEnd = Carbon::parse($employee->shift->break_end_at)->setDate($Y, $m, $d);
//            }
//
//            foreach ($days as $dayLogs) {
//                $previousStatus = 1;
//                for ($i=0; $i< count($dayLogs); $i++) { // Begin dayLog
//                    $dayLog = $dayLogs[$i];
//
//                    $done[] = $dayLog->id;
//
//                    $checkTime = Carbon::parse($dayLog->date)->setDate($Y, $m, $d);
//
//                    if($employee->shift->break && $checkTime->between($shiftBreakStart, $shiftBreakEnd)) {
//                        $status = $dayLog->status == 'in' ? 3 : 2;
//                        $status_duration = $dayLog->status == 'in' ?
//                            ($shiftBreakStart->diffInMinutes($checkTime, false) > 0 ? '' : $shiftBreakStart->diffInMinutes($checkTime, false)) : '';
//                    }
//                    else {
//                        if($dayLog->status == 'in') {
//                            $status = 1;
//                            $status_duration = $checkTime->setDate($Y, $m, $d)->diffInMinutes($shiftStart, false);
//                        }
//                        else {
//                            $status = 5;
//                            $status_duration = $shiftEnd->setDate($Y, $m, $d)->diffInMinutes($checkTime, false);
//                        }
//                    }
//
////                    if($i == 0) {
////                        $status = 1;
////                        $status_duration = $checkTime->setDate($Y, $m, $d)->diffInMinutes($shiftStart, false);
////                    }
////                    else if($i == count($dayLogs) - 1 && ($i % 2 == 0)) {
////                        $status = 4;
////                        $status_duration = $shiftEnd->setDate($Y, $m, $d)->diffInMinutes($checkTime, false);
////                    }
////                    else {
////                        if($i % 2 != 0) { // check in
////                            if($employee->shift->break && $checkTime->between($shiftBreakStart, $shiftBreakEnd)) {
////                                $status = 2;
////                                $previousStatus = 2;
////                                $status_duration = $shiftBreakStart->diffInMinutes($checkTime, false);
////                            }
////                            else {
////                                $status = 5;
////                                $status_duration = '';
////                            }
////                        }
////                        else { // check out
////                            if($previousStatus == 2) {
////                                $previousStatus = 1;
////                                $status = 3;
////                                $status_duration = $checkTime->diffInMinutes($shiftBreakEnd, false);
////                            }
////                            else {
////                                $status = 6;
////                                $status_duration = '';
////                            }
////                        }
////
////                    }
//
//                    $activities[] = [
//                        'employee_id' => $employee->id,
//                        'user_id' => $employee->client->id,
//                        'shift_id' => $employee->shift->id,
//                        'status_id' => $status,
//                        'device_id' => $dayLog->device_id,
//                        'registered_time' => $dayLog->date,
//                        'status_duration' => $status_duration,
//                        'created_at' => Carbon::now(),
//                        'updated_at' => Carbon::now(),
//                    ];
//                } // End dayLog
//            }
//        }
//        if(count($done)) {
//            DB::transaction(function () use ($activities, $done) {
//                DB::table((new EmployeesActivity)->getTable())->insert($activities);
//
//                $attendanceLog = (new AttendanceLog)->getTable();
//                $attendanceLogArchive = (new AttendanceLogArchive)->getTable();
//
//                $done = implode(',', $done);
//
//                DB::statement("INSERT INTO {$attendanceLogArchive} (employee_fingerprint_id, device_id, status, `date`, created_at, updated_at) SELECT employee_fingerprint_id, device_id, status, `date`, NOW() as created_at, NOW() as updated_at FROM {$attendanceLog}");
//                DB::statement("DELETE FROM {$attendanceLog} WHERE id IN({$done})");
//            });
//        }
//    }


}