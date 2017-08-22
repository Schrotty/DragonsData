<?php

namespace App\Listeners;

use App\Events\AccessGrantedEvent;
use App\Events\AccessLostEvent;
use App\Events\NewsPublished;
use App\Notifications\AccessGranted;
use App\Notifications\AccessLost;
use App\Notifications\NewsPublish;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class AccessLostNotification
{
    /**
     * Create the event listener.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     *
     * @param  NewsPublished  $event
     * @return void
     */
    public function handle(AccessLostEvent $event)
    {
        //abort(418, "'I'am a teapot");
        foreach($event->subscriber as $_id)
        {
            User::find($_id)->notify(new AccessLost($event->item));
        }
    }
}
