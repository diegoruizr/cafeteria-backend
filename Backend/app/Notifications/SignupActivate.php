<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;

class SignupActivate extends Notification
{
    use Queueable;

    /**
     * Crea una nueva instancia dela notificación.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    /**
     * Recibe los canales de entrega de la notificación..
     *
     * @param  mixed  $notifiable
     * @return array
     */
    public function via($notifiable)
    {
        return ['mail'];
    }

    /**
     * Obtiene la representación por correo de la notificación.
     *
     * @param  mixed  $notifiable
     * @return \Illuminate\Notifications\Messages\MailMessage
     */
    public function toMail($notifiable)
    {
        $url = url('/api/auth/signup/activate/'.$notifiable->activation_token);
         return (new MailMessage)
             ->subject('Confirma tu cuenta')
             ->line('Gracias por suscribirte! Antes de continuar, debes configurar tu cuenta.')
             ->line('Tu contraseña para ingresar es: '. $notifiable->password)
             ->action('Confirmar tu cuenta', url($url))
             ->line('Muchas gracias por utilizar nuestra aplicación!');
    }

    /**
     * Obtiene la representación matricial de la notificación.
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
