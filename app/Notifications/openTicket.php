<?php

namespace App\Notifications;

use App\Models\ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class openTicket extends Notification
{
    use Queueable;

    public $openTicket;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(ticket $openTicket)
    {
        //
        $this->openTicket=$openTicket;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','broadcast'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */


    public function toDatabase($notifiable)
    {
        return[
            'ticket_id'=>$this->openTicket->id,
            'userphoto'=>$this->openTicket->user->photo,
            'username'=>$this->openTicket->user->name,
            'created_at'=>$this->openTicket->created_at->diffForHumans(),
        ];
    }

    public function toBroadcast($notifiable)
    {

        return new BroadcastMessage([
            'ticket_id'=>$this->openTicket->id,
            'userphoto'=>$this->openTicket->user->photo,
            'username'=>$this->openTicket->user->name,
            'created_at'=>$this->openTicket->created_at->diffForHumans(),
        ]);
    }


}
