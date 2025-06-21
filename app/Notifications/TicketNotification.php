<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class TicketNotification extends Notification
{
    use Queueable;

    protected $message;
    protected $type;
    protected $link;

    public function __construct($message, $type, $link)
    {
        $this->message = $message;
        $this->type = $type;
        $this->link = $link;
    }

    public function via($notifiable)
    {
        return ['database'];
    }

    public function toArray($notifiable)
    {
        return [
            'message' => $this->message,
            'type' => $this->type,
            'link' => $this->link,
        ];
    }
}
