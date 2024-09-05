<?php

namespace App\Jobs;

use App\Events\SubmissionSavedEvent;
use App\Models\Submission;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\SerializesModels;

class ProcessSubmissionsJob implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(private array $payload)
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $submission = Submission::create($this->payload);
        event(new SubmissionSavedEvent($submission));
    }
}
