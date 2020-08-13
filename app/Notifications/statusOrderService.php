<?php

namespace App\Notifications;

use App\User;
use App\Models\Order;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class statusOrderService extends Notification
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

        if($this->order->status==1){
            $message= 'Congratulations, the service was successfully accepted by the buyer and the amount was successfully transferred to your account on the site';
        }elseif($this->order->status==2){
            $message= 'Sorry, the service was refused by the buyer, please resend the service attachments' ;
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

        
        if($this->order->status==1){
            $message_en= 'Congratulations, the service was successfully accepted by the buyer and the amount was successfully transferred to your account on the site';
            $message_ar='مبروك تم قبول الخدمة من قبل المشترى بنجاح وتم تحويل المبلغ الى حسابك على الموقع';
        }elseif($this->order->status==2){
            $message_en= 'Sorry, the service was refused by the buyer, please resend the service attachments';
            $message_ar= 'عذرا, تم رفض الخدمة من المشترى برجاء ارسال مرفقات الخدمة مرة اخرى';
        }

        return[
            'username'=>$this->order->user->name,
            'userphoto'=>$this->order->user->photo,
            'message_en'=>$message_en,
            'message_ar'=>$message_ar,
            'order_id'=>$this->order->id,
        ];
    }

    public function toBroadcast($notifiable)
    {

        if($this->order->status==1){
            $message_en= 'Congratulations, the service was successfully accepted by the buyer and the amount was successfully transferred to your account on the site';
            $message_ar='مبروك تم قبول الخدمة من قبل المشترى بنجاح وتم تحويل المبلغ الى حسابك على الموقع';
        }elseif($this->order->status==2){
            $message_en= 'Sorry, the service was refused by the buyer, please resend the service attachments';
            $message_ar= 'عذرا, تم رفض الخدمة من المشترى برجاء ارسال مرفقات الخدمة مرة اخرى';
        }

        return new BroadcastMessage([
         
            'username'=>$this->order->user->name,
            'userphoto'=>$this->order->user->photo,
            'message_en'=>$message_en,
            'message_ar'=>$message_ar,
            'order_id'=>$this->order->id,
            'created_at'=>$this->order->updated_at->diffForHumans()

        ]);
    }
}
