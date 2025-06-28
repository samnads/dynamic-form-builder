<?php

namespace App\Listeners;

use App\Events\FormCreated;
use App\Mail\FormCreatedMail;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Mail;

class SendFormCreatedEmail implements ShouldQueue
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
    public function handle(FormCreated $event): void
    {
        Mail::to(env('MAIL_TO_ADDRESS'))->send(new FormCreatedMail($event->form));
    }
}
