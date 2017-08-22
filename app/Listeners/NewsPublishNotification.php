<?php

namespace App\Listeners;

use App\Events\NewsPublished;
use App\Notifications\NewsPublish;
use App\User;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;

class NewsPublishNotification
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
    public function handle(NewsPublished $event)
    {
        //abort(418, "'I'am a teapot");
        foreach(User::all() as $user)
        {
            $user->notify(new NewsPublish($event->news));
        }
    }
}
