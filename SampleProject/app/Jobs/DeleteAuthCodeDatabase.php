<?php

namespace App\Jobs;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use App\Models\AuthCode;

class DeleteAuthCodeDatabase implements ShouldQueue
{
    use Queueable;

    public $authCode;
    /**
     * Create a new job instance.
     */
    public function __construct($authCode)
    {
        $this->authCode = $authCode;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        AuthCode::where('id', $this->authCode)->delete();
    }
}
