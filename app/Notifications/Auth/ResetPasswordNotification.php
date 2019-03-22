<?php

namespace App\Notifications\Auth;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends Notification
{
    use Queueable;
    /**
     * @var
     */
    private $token;

    /**
     * Create a new notification instance.
     *
     * @param $token
     */
    public function __construct($token)
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
            ->subject('Modifier mon mot de passe')
            ->greeting("Bonjour")
            ->line("Suite a votre demande de reinitialisation du mot de passe de votre compte LYTheGround")
            ->action("Modifié mon mot de passe", route('password.reset',['token' => $this->token]))
            ->line('Ce message vous a été envoyer suite a la tentative de votre mot de passe!')
            ->salutation("Cordialement")
            ->salutation(env('APP_NAME', 'The Ground LY'));
    }
}
