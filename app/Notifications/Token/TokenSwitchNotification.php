<?php

namespace App\Notifications\Token;

use App\Token;
use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class TokenSwitchNotification extends Notification
{
    use Queueable;
    /**
     * @var Token
     */
    private $token;

    /**
     * Create a new notification instance.
     *
     * @param Token $token
     */
    public function __construct(Token $token)
    {
        $this->token = $token;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
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
            ->from('noreply@thegrounly.com')
            ->subject("Jeton d'inscription")
            ->greeting("Bonjour")
            ->line("Bienvenu Sur Notre Système The Ground LY")
            ->line("L'or de votre inscription sur notre système vous aurais invité d'indiquez votre Jeton de sécurité")
            ->line("Jeton : " . $this->token->token)
            ->action("Inscription", route('register'))
            ->line("Ce jeton est conçu pour une seul utilisation il sera immédiatement supprimé")
            ->salutation("Cordialement")
            ->salutation('The Ground LY');
    }
}
