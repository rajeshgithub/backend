<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\sendMailDemo;
use Illuminate\Support\Facades\Mail;

class sendMailJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;
    protected $sendMail;
    /**
     * Create a new job instance.
     */
    public function __construct($sendMail)
    {
        $this->sendMail = $sendMail;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $email = new sendMailDemo();
        Mail::to($this->sendMail)->send($email);
    }
}
