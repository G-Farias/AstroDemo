<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;



class ResetPasswordNotification extends Notification
{
    use Queueable;

    public $token;

    public function __construct($token)
    {
        $this->token = $token;
    }

    public function via($notifiable)
    {
        return ['mail'];
    }

    public function toMail($notifiable)
    {
        $url = url(route('password.reset', ['token' => $this->token, 'email' => $notifiable->getEmailForPasswordReset()], false));

        return (new MailMessage)
            ->subject('Restablecer contraseña')
            ->greeting('Restablecer contraseña.')
            ->line('Recibimos una solicitud para restablecer la contraseña de su cuenta.')
            ->action('Restablecer contraseña', $url)
            ->line('Este enlace expirará en 60 minutos.')
            ->line('Si usted no solicitó el cambio, no es necesario realizar ninguna acción.');
    }
}
