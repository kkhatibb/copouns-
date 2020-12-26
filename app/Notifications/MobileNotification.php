<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class MobileNotification extends Notification
{
    use Queueable;

    /**
     * Create a new notification instance.
     *
     * @return void
     */

    protected $data;

    public function __construct($text, $description,$id, $type, $array = [])
    {
        $data = ['title'=>$text,'description'=>$description,'id' => $id, 'type' => $type];
        $this->data = count($array) > 0 ? array_merge($data, $array) : $data;
    }


    public function via($notifiable)
    {
        $notifiable->sendNotification($this->data);
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return $this->data;
    }
}
