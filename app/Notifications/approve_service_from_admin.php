<?php

namespace App\Notifications;

use App\Models\Service_work;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class approve_service_from_admin extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Service_work $service)
    {
        //
        $this->service=$service;

    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['broadcast','database','mail'];
    }

    /**
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        if($this->service->approve==1){
            $message='Congratulations, The service has been approved from manager';
        }elseif($this->service->approve==2){
            $message='Sorry, The service has been rejected by manager for not going on with conditions, please edit the service';
        }elseif($this->service->approve==3){
            $message='Your service has been banned by the administrator';
        }
        return (new MailMessage)
                    ->line('Hi '.$this->service->user->name)
                    ->subject('joker jop Notification')
                    ->line($message)
                    ->from('bishoywafik123@gmail.com')
                    ->line('Thank you for using our Joker jop application!');
    }


    public function toDatabase($notifiable)
    {

        if($this->service->approve==1){
            $message_en='Congratulations, The service has been approved from manager';
            $message_ar='مبروك تم الموافقة على الخدمة من المدير';
        }elseif($this->service->approve==2){
            $message_en='Sorry, The service has been rejected by manager for not going on with conditions, please edit the service';
            $message_ar='Congratulations, The service has been approved from manager';
        }elseif($this->service->approve==3){
            $message_en='Your service has been banned by the administrator';
            $message_ar='تم حظر الخدمة الخاصة بك من قبل المدير';
        }

        return [
            'message_en'=>$message_en,
            'message_ar'=>$message_ar,
            'service_id'=>$this->service->id
        ];
    }



    public function toBroadcast($notifiable)
    {
     
        if($this->service->approve==1){
            $message_en='Congratulations, The service has been approved from manager';
            $message_ar='مبروك تم الموافقة على الخدمة من المدير';
        }elseif($this->service->approve==2){
            $message_en='Sorry, The service has been rejected by manager for not going on with conditions, please edit the service';
            $message_ar='Congratulations, The service has been approved from manager';
        }elseif($this->service->approve==3){
            $message_en='Your service has been banned by the administrator';
            $message_ar='تم حظر الخدمة الخاصة بك من قبل المدير';
        }

        return new BroadcastMessage([
            'message_en'=>$message_en,
            'message_ar'=>$message_ar,
            'service_id'=>$this->service->id,
            'created_at'=>$this->service->created_at->diffForHumans()
        ]);
    }

}
