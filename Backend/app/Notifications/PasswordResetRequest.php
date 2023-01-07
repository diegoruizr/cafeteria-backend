<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Notifications\Notification;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
class PasswordResetRequest extends Notification implements ShouldQueue
{
    use Queueable;
    protected $token;
    protected $route;
    /**
    * Crea la instancia de una notificacion.
    *
    * @return void
    */
    public function __construct($token, $route)
    {
        $this->token = $token;
        $this->route = $route;
    }
    /**
    *
    *Recibe los canales de entrega de la notificación.
    *
    * @param  mixed  $notifiable
    * @return array
    */
    public function via($notifiable)
    {
        return ['mail'];
    }
    /**
    *
    *Obtiene la representación de correo de la notificación.
    *
    * @param  mixed  $notifiable
    * @return \Illuminate\Notifications\Messages\MailMessage
    */
    public function toMail($notifiable)
    {
        $url = url($this->route."/".$this->token);
        return (new MailMessage)
            ->subject('Establecer contraseña')
            ->line('Bienvenidos a Piciz web, por favor haga click en el boton de cambiar contraseña para establecer una contraseña propia.')
            ->action('Cambiar contraseña', url($url))
            ->line('');
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
