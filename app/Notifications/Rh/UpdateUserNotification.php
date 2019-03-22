<?php

namespace App\Notifications\Rh;

use App\User;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class UpdateUserNotification extends Notification
{
    use Queueable;
    /**
     * @var
     */
    private $user;

    /**
     * Create a new notification instance.
     *
     * @param  $user
     */
    public function __construct($user)
    {
        $this->user = $user;
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
        $img = ($this->user->member->info->face) ? $this->user->member->info->face : null;
        if ($img)  {$return['img'] = $img;}
        $return['name'] = $this->user->member->info->full_name;
        $return['request'] = 'rh/member.request_update';
        $return['action'] = 'rh/member.action_update';
        $return['route'] = route('member.show',['member' => $this->user->member]);
        return $return;
    }
}
