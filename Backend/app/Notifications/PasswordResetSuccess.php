<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
class PasswordResetSuccess extends Notification implements ShouldQueue
{
    use Queueable;

    /**
    * Crea un ainstancia de la notificacion.
    *
    * @return void
    */
    public function __construct()
    {
        //
    }
    /**
    * Recibe los canales de entrega de la notificación.
    *
    * @param  mixed  $notifiable
    * @return array
    */
    public function via($notifiable)
    {
        return ['mail'];
    }
    /**
    * Obtiene la representación de correo de la notificación.
    *
    * @param  mixed  $notifiable
    * @return \Illuminate\Notifications\Messages\MailMessage
    */
    public function toMail($notifiable)
    {
        return (new MailMessage)
            ->subject('Confirmacion de contraseña')
            ->line('Has cambiado tu contraseña correctamente.')
            ->line('Si cambió la contraseña, no se requiere ninguna otra acción.')
            ->line('Si no cambió la contraseña, proteja su cuenta.');
    }
/**
     *
     *Obtiene la representación matricial de la notificación.
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function toArray($notifiable)
    {
        return [
            //
        ];
    }
}
