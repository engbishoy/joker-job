<?php

namespace App\Notifications;

use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class cronJobExpireTime extends Notification
{
    use Queueable;
    public $order,$message,$type;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Order $order,$message,$type)
    {
        //
        $this->order=$order;
        $this->message=$message;
        $this->type=$type;
    }

    public function via($notifiable)
    {
        return ['database','mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */


    public function toMail($notifiable)
    {                
        $message= $this->message;

        if($this->type=='buyer'){
        $link =route('myorders.show',['id'=>$this->order->id]);
        }elseif($this->type=='seller'){
         $link=route('requests_received.show',['id'=>$this->order->id]);
        }

        return (new MailMessage)    
        ->subject('joker jop Notification')
        ->line($message)
        ->from('bishoywafik123@gmail.com')
        ->action('See order', $link)
        ->line('Thank you for using our Joker jop application!');
    }



    public function toDatabase($notifiable)
    {

        return[
            'order_id'=>$this->order->id,
            'message'=>$this->message,
            'type_user'=>$this->type,
            'created_at'=>$this->order->updated_at->diffForHumans(),
        ];
    }

 
    
}
