<?php

namespace App\Jobs;

use App\Models\Device;
use App\Repositories\FingerprintsRepository;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Support\Facades\Log;

class ReadAttendanceLogData implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * @var Device
     */
    protected $device;

    /**
     * Create a new job instance.
     * @param Device $device
     * @return void
     */
    public function __construct(Device $device)
    {
        $this->device = $device;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Log::info('Device: ' . $this->device->id);
        $fingerprint = new FingerprintsRepository($this->device);

        $fingerprint->storeAttendanceLogs();
    }
}
