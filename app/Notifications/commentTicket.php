<?php

namespace App\Notifications;

use App\User;
use App\Models\Admin;
use Illuminate\Bus\Queueable;
use App\Models\Comment_ticket;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Messages\BroadcastMessage;

class commentTicket extends Notification
{
    use Queueable;

    public $commentTicket;
    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct(Comment_ticket $commentTicket)
    {
        //
        $this->commentTicket=$commentTicket;
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
        if($this->commentTicket->is_admin==0){
            $adminid=$this->commentTicket->admin_id;
            $admin=Admin::find($adminid);
            return (new MailMessage)    
            ->line('Hi '.$admin->name)
            ->subject('joker jop Notification')
            ->line('A new comment on ticket has been sent')
            ->action('See ticket',route('technical.ticket.show',['id'=>$this->commentTicket->ticket_id]))
            ->from('bishoywafik123@gmail.com')
            ->line('Thank you for using our Joker jop application!');

        }else{
        $userid=$this->commentTicket->user_id;
        $user=User::find($userid);
        return (new MailMessage)    
        ->line('Hi '.$user->name)
        ->subject('joker jop Notification')
        ->line('Your ticket was answered by technical support.')
        ->action('See ticket',route('ticket.show',['id'=>$this->commentTicket->ticket_id]))
        ->from('bishoywafik123@gmail.com')
        ->line('Thank you for using our Joker jop application!');
    }


   }

    public function toDatabase($notifiable)
    {
        return[
            'ticket_id'=>$this->commentTicket->ticket_id,
            'userphoto'=>$this->commentTicket->user->photo,
            'username'=>$this->commentTicket->user->name,
            'adminphoto'=>$this->commentTicket->admin->photo,
            'created_at'=>$this->commentTicket->created_at->diffForHumans(),
        ];
    }

    public function toBroadcast($notifiable)
    {

        return new BroadcastMessage([
            'ticket_id'=>$this->commentTicket->ticket_id,
            'userphoto'=>$this->commentTicket->user->photo,
            'username'=>$this->commentTicket->user->name,
            'adminphoto'=>$this->commentTicket->admin->photo,
            'created_at'=>$this->commentTicket->created_at->diffForHumans(),
        ]);
    }
}
