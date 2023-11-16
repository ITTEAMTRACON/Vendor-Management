<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Mail;

class SendEmailForgetPassword implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;
    public $maxExceptions = 3;
    public $retryAfter = 120;
    protected $email;
    protected $name;
    protected $code;

    /**
     * Create a new job instance.
     */
    public function __construct($email, $name, $code)
    {
        $this->email = $email;
        $this->name = $name;
        $this->code = $code;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        // dd($this->email);
        $GLOBALS['emailForgotPassword']  = $this->email;
        $data = ['name'=>$this->name, 'image'=>asset('/images/tracon_logo.jpg') , 'token'=>$this->code];

        Mail::send('email.forgetpassword', $data, function ($m) {
            $m->to($GLOBALS['emailForgotPassword'])->subject('Tracon Vendor Management - Forgot Password');
        });
    }
}
