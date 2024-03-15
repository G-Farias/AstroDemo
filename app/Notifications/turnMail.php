<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;


class turnMail extends Notification
{
    use Queueable;

    protected $ReservedTurn;
    /**
     * Create a new notification instance.
     */
    public function __construct(object $ReservedTurn)
    {
        $this->ReservedTurn = $ReservedTurn;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    public function via(object $notifiable): array
    {
        return ['mail'];
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {

        return (new MailMessage)
                    ->line(ucfirst($this->ReservedTurn->nombre) .' '. ucfirst($this->ReservedTurn->apellido) . ' faltan 2 días para tu turno.')
                    ->action('Ver mis turnos', url('/reservarTurno/misTurnos'))
                    ->line('¡Esperamos tu asistencia! En caso contrario, puedes cancelarlo o comunicarte con nosotros');
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
     */
    public function toArray(object $notifiable): array
    {
        return [
            //
        ];
    }
}
