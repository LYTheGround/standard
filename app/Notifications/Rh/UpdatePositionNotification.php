<?php

namespace App\Notifications\Rh;

use App\Position;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UpdatePositionNotification extends Notification
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
        $return['request'] = 'rh/member.request';
        $return['action'] = 'rh/member.action';
        $return['route'] = route('member.show',['member' => $this->position->info]);
        return $return;
    }
}
