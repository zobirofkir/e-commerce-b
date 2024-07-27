<?php

namespace App\Jobs;

use App\Mail\OrderMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Foundation\Queue\Queueable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;

class OrderJob implements ShouldQueue
{
    use Queueable;
    private $orderResource;

    /**
     * Create a new job instance.
     */
    public function __construct($orderResource)
    {
        $this->orderResource = $orderResource;;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        Mail::to('zobirofkir19@gmail.com')->send(new OrderMail($this->orderResource));
    }
}
