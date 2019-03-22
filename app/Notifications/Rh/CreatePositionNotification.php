<?php

namespace App\Notifications\Rh;

use App\Position;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class CreatePositionNotification extends Notification
{
    use Queueable;
    /**
     * @var Position
     */
    private $position;

    /**
     * Create a new notification instance.
     *
     * @param Position $position
     */
    public function __construct(Position $position)
    {
        $this->position = $position;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['database'];
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        $img = ($this->position->info->face) ? $this->position->info->face : null;
        if ($img)  {$return['img'] = $img;}
        $return['name'] = $this->position->info->full_name;
        $return['request'] = 'rh/position.request';
        $return['action'] = 'rh/position.action';
        $return['route'] = route('position.show',['member' => $this->position]);
        return $return;
    }
}
