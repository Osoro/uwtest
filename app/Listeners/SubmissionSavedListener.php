<?php

namespace App\Listeners;

use App\Events\SubmissionSavedEvent;
use Illuminate\Support\Facades\Log;

class SubmissionSavedListener
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(SubmissionSavedEvent $event): void
    {
        Log::channel('submission')->info('Submission successful saved', [
            'name' => $event->submission->name,
            'email' => $event->submission->email
        ]);
    }
}
