<?php

namespace App\Notifications;

use App\User;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class statusSaleService extends Notification
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
        $userid=$this->order->user_id;
        $user=User::find($userid);

        if($this->order->sale_service_approve==1){
            $message= $this->order->service->user->name. 'Accept your order for service :'. $this->order->service->title;
        }elseif($this->order->sale_service_approve==2){
            $message= $this->order->service->user->name. 'Cancel your order for service :'. $this->order->service->title;
        }

        return (new MailMessage)    
        ->line('Hi '.$user->name)
        ->subject('joker jop Notification')
        ->line($message)
        ->from('bishoywafik123@gmail.com')
        ->line('Thank you for using our Joker jop application!');
    }

    public function toDatabase($notifiable)
    {

        if($this->order->sale_service_approve==1){
            $message_en='Accept your order';
            $message_ar='وافق على طلبك';
        }elseif($this->order->sale_service_approve==2){
            $message_en='Cancel your order';
            $message_ar='رفض طلبك';
         }

        return[
            'username'=>$this->order->service->user->name,
            'userphoto'=>$this->order->service->user->photo,
            'order_id'=>$this->order->id,
            'message_en'=>$message_en,
            'message_ar'=>$message_ar,
        ];
    }

    public function toBroadcast($notifiable)
    {

        if($this->order->sale_service_approve==1){
            $message_en='Accept your order';
            $message_ar='وافق على طلبك';
        }elseif($this->order->sale_service_approve==2){
            $message_en='Cancel your order';
            $message_ar='رفض طلبك';
         }

        return new BroadcastMessage([
            'username'=>$this->order->service->user->name,
            'userphoto'=>$this->order->service->user->photo,
            'order_id'=>$this->order->id,
            'message_en'=>$message_en,
            'message_ar'=>$message_ar,
            'created_at'=>$this->order->updated_at->diffForHumans()

        ]);
    }
}
