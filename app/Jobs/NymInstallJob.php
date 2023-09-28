<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Facades\Log;
use Exception;

class NymInstallJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $details;

    public $timeout = 300; //300 seconds (5 minutes) for processing a single job

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($details)
    {
        $this->details = $details;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $installCommand = $this->details['command'];
        Log::info($installCommand);

        try {
            $output = [];
            $returnCode = 0;
            exec($installCommand, $output, $returnCode);

            if ($returnCode === 0) {
                Log::info("NymInstallJob: Node Installation Succeeded.");
                Log::info("Output: " . implode(PHP_EOL, $output));
            } else {
                Log::error("NymInstallJob: Node Installation Failed with Error Code $returnCode");
                Log::error("Output: " . implode(PHP_EOL, $output));
            }
        } catch (\Throwable $e) {
            Log::error("NymInstallJob: An exception occurred while executing the command: " . $e->getMessage());
            Log::error("Exception Trace: " . $e->getTraceAsString());
        }
    }
}
