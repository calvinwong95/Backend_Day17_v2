<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Mail\QueueEmail;
use Illuminate\Support\Facades\Mail;

class QueueJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $email_list;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
        // $this->email_list = $email_list;
    }

    /**
     * Execute the job.
     *
     * @return void
     */


    public function handle()
    {
        //
        // $email = new QueueEmail();
        // Mail::to($this->email_list['email'])->send($email);
        Mail::to('calvinwongch95@gmail.com')->send(new QueueEmail());
    }
}
