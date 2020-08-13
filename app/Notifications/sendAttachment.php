<?php

namespace App\Notifications;

use App\User;
use Illuminate\Bus\Queueable;
use App\Models\Service_attachment;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class sendAttachment extends Notification
{
    use Queueable;
    public $attachment;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Service_attachment $attachment)
    {
        //
        $this->attachment=$attachment;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database','broadcast','mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
    
        $userid=$this->attachment->order->user_id;
        $user=User::find($userid);

        $message= $this->attachment->user->name. 'Send you attachment service :'. $this->attachment->order->service->title;

        return (new MailMessage)    
        ->line('Hi '.$user->name)
        ->subject('joker jop Notification')
        ->line($message)
        ->from('bishoywafik123@gmail.com')
        ->action('See attachment', route('orders.show',['id'=>$this->attachment->order_id]))
        ->line('Thank you for using our Joker jop application!');

    }



    public function toDatabase($notifiable)
    {
        return new BroadcastMessage([
            'username'=>$this->attachment->user->name,
            'userphoto'=>$this->attachment->user->photo,
            'order_id'=>$this->attachment->order_id,
            'created_at'=>$this->attachment->updated_at->diffForHumans()

        ]);
    }


    public function toBroadcast($notifiable)
    {
        return new BroadcastMessage([
            'username'=>$this->attachment->user->name,
            'userphoto'=>$this->attachment->user->photo,
            'order_id'=>$this->attachment->order_id,
            'created_at'=>$this->attachment->updated_at->diffForHumans()

        ]);
    }

    
}
