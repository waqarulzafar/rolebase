<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class FileNotification extends Notification
{
    use Queueable;
    public $message="";
    public $fileUrl="";
    public $user=null;

    /**
     * Create a new notification instance.
     *
     * @return void
     */
    public function __construct($message,$fileUrl,$user=null)
    {
        //

        $this->message=$message;
        $this->fileUrl=$fileUrl;
        $this->user=$user;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail','database'];
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
                    ->line($this->message)
                    ->action('View File', $this->fileUrl)
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
            'url'=>$this->fileUrl,
            'user'=>$this->user,
            'message'=>$this->message,
        ];
    }
}
