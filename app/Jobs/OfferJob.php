<?php

namespace App\Jobs;

use App\Mail\OfferMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class OfferJob implements ShouldQueue
{
    use Queueable;
    protected $request;

    /**
     * Create a new job instance.
     */
    public function __construct($request)
    {
        $this->request = $request;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to('zobirofkir19@gmail.com')->send(new OfferMail($this->request));
    }
}
