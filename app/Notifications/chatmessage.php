<?php

namespace App\Notifications;

use App\Models\Chat;
use Illuminate\Support\Str;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;


class chatmessage extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Chat $chat ,$chatPhotos)
    {
        //
         $this->chat=$chat;
         $this->chatPhotos=$chatPhotos;
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
        return (new MailMessage)
                    ->line('Hi '.$this->chat->touser->name)
                    ->subject('joker jop Notification')
                    ->line('Yo have new message .')
                    ->from('bishoywafik123@gmail.com')
                    ->action('See message', route('chat',['id'=>$this->chat->from]))
                    ->line('Thank you for using our Joker jop application!');
    }


    public function toDatabase($notifiable)
    {

        return [
            'fromuserphoto'=>$this->chat->fromuser->photo,
            'fromusername'=>$this->chat->fromuser->name,
            'fromuserid'=>$this->chat->from,
            'message'=>$this->chat->message,
            'photos'=>$this->chatPhotos,
        ];
    }



    public function toBroadcast($notifiable)
    {
     
        return new BroadcastMessage([

            'fromuserphoto'=>$this->chat->fromuser->photo,
            'fromusername'=>$this->chat->fromuser->name,
            'fromuserid'=>$this->chat->from,
            'message'=>Str::limit($this->chat->message,20),
            'photos'=>$this->chatPhotos,
            'created_at'=>$this->chat->created_at->diffForHumans()
        ]);
    }

   
    
}
