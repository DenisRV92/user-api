<?php

namespace App\Listeners;

use App\Events\ApplicationResolved;
use App\Models\User;
use App\Notifications\NullNotification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Notifications\AnonymousNotifiable;

class SendNullNotification implements ShouldQueue
{


    /**
     * Create the event listener.
     */
    public function __construct()
    {

    }

    /**
     * Handle the event.
     */
    public function handle(ApplicationResolved $event): void
    {
        $event->user->notify(new NullNotification());
    }
}
