<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

use Illuminate\Support\Facades\Log;

class NymInstallJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $details;

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

        exec($installCommand, $output, $returnCode);

        if ($returnCode === 0) {
            Log::info("NymInstallJob: Node Installation Start Successfully.");
            Log::info($output);
        } else {
            Log::info("NymInstallJob: Node Installation failed with error");
            Log::error($output);
        }
    }
}
