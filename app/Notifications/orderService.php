<?php

namespace App\Notifications;

use App\Models\Order;
use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class orderService extends Notification
{
    use Queueable;

    public $order;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Order $order)
    {
        //
        $this->order=$order;
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
        $userid=$this->order->service->user_id;
        $user=User::find($userid);
        return (new MailMessage)    
        ->line('Hi '.$user->name)
        ->subject('joker jop Notification')
        ->line('Yo have new order on your service.')
        ->action('See Order',route('requests_received.show',['id'=>$this->order->id]))
        ->from('bishoywafik123@gmail.com')
        ->line('Thank you for using our Joker jop application!');
    }

    public function toDatabase($notifiable)
    {
        return[
            'username'=>$this->order->user->name,
            'userphoto'=>$this->order->user->photo,
            'order_id'=>$this->order->id,
        ];
    }

    public function toBroadcast($notifiable)
    {

        return new BroadcastMessage([
            'username'=>$this->order->user->name,
            'userphoto'=>$this->order->user->photo,
            'order_id'=>$this->order->id,
            'created_at'=>$this->order->created_at->diffForHumans()

        ]);
    }
 
}
