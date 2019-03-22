<?php

namespace App\Notifications\Deal;

use App\Deal;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class CreateDealNotification extends Notification
{
    use Queueable;


    private $deal;


    public function __construct(Deal $deal)
    {
        $this->deal = $deal;
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
            ->from('noreply@thegroundly.com')
            ->subject('Un nouveau Deal a été ajouté')
            ->greeting("Bonjour")
            ->markdown('mail.deal.create', [
                'url' => route('deal.show', ['deal' => $this->deal]),
                'deal' => $this->deal
            ]);
    }

    /**
     * Get the array representation of the notification.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {

        $return['name'] = $this->deal->infoBox->name;

        $return['request'] = 'deal/deal.request';

        $return['action'] = 'deal/deal.action';

        $return['route'] = route('deal.show',['deal' => $this->deal]);

        return $return;

    }
}
