<?php

namespace App\Jobs;

use App\Models\User;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Mail\Mailable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Redis;

class ThrottledMail implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $mail;
    public $user;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public function __construct(Mailable $mail, User $user)
    {
        $this->mail = $mail;
        $this->user = $user;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        Redis::throttle('mailhog')->allow(4)->every(10)->then(function () {
            Mail::to($this->user)->send($this->mail);
        }, function () {
            return $this->release(5);
        });
    }
}
