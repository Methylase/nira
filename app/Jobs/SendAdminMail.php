<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use App\Mail\AdminMail;

class SendAdminMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $email;
    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct($email)
    {
      $this->email = $email;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle(){

        Mail::to('methyl2007@yahoo.com')->send(new AdminMail($this->email));
    }
}
