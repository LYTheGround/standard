<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class AccountLimitNotification extends Notification
{
    use Queueable;
    /**
     * @var
     */
    private $limit;
    /**
     * @var
     */
    private $days;
    /**
     * @var
     */
    private $nbrDay;

    /**
     * Create a new notification instance.
     *
     * @param $limit
     * @param $days
     * @param $nbrDay
     */
    public function __construct($limit, $days,$nbrDay)
    {
        //
        $this->limit = $limit;
        $this->days = $days;
        $this->nbrDay = $nbrDay;
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
     * Get the mail representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        return (new MailMessage)
                    ->line('The introduction to the notification.')
                    ->action('Notification Action', url('/'))
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
            'img'               => 'logo.png',
            'name'              => 'The Ground LY',
            'request'           => __("rh/premium.request",['value' => $this->nbrDay ]),
            'action'            => __('rh/premium.action'),
            'route'             => '#',
            'notification_id'   => $this->limit . '-' . $this->days
        ];
    }

    public function notifiable()
    {
        if(isset($this->data['limit'])){
            $this->notification_id = $this->limit . '-' . $this->days;
        }
        else{
            $this->notification_id = null;
        }
    }
}
