<?php

namespace App\Jobs;

use App\Mail\NewsletterSubscriberWelcomeEmail;
use App\Models\NewsletterSubscriber;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;

class NewsletterSubscriberWelcomeMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public NewsletterSubscriber $subscriber)
    {
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        try {
            Mail::to($this->subscriber->email)->send(new NewsletterSubscriberWelcomeEmail($this->subscriber));
        } catch (\Exception $e) {
            Log::error($e->getMessage());
        }
    }
}
