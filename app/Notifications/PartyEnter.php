<?php

namespace App\Notifications;

use App\Channels\Mongofication;
use App\Item;
use App\News;
use App\Party;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class PartyEnter extends Notification
{
    use Queueable;

    public $party;

    protected $dates = ['created_at', 'updated_at'];

    /**
     * Create a new notification instance.
     *
     * @param Party $party
     */
    public function __construct(Party $party)
    {
        $this->party = $party;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return [Mongofication::class];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
                    ->line('Thank you for using our application!');
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            'id' => $this->party->_id,
            'title' => $this->party->name,
            'type' => 'notification-access-granted',
            'route' => 'party',
            'message' => 'Access granted!',
            'icon' => 'lock-unlocked'
        ];
    }
}
