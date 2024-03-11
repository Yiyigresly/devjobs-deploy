<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\MailMessage;
use Illuminate\Notifications\Notification;

class NewCandidate extends Notification
{
    use Queueable;

    private $vacancy_id;
    private $user_id;
    private $vacancy_title;
    /**
     * Create a new notification instance.
     */
    // pasamos la informacion que se deseas
    public function __construct($vacancy_id, $vacancy_title, $user_id)
    {
        $this->vacancy_id = $vacancy_id;
        $this->user_id = $user_id;
        $this->vacancy_title = $vacancy_title;
    }

    /**
     * Get the notification's delivery channels.
     *
     * @return array<int, string>
     */
    // por defecto via email o tb puedes almacenarla en una base de datos
    public function via(object $notifiable): array
    {
        return ['mail','database']; // enviar via email y tambien alamacenar en la database
    }

    /**
     * Get the mail representation of the notification.
     */
    public function toMail(object $notifiable): MailMessage
    {
        $url = url('/notifications' ); // se va a crear
        return (new MailMessage)
                    ->line('Has recibido un nuevo candidato en tu vacante.')
                    ->line('La vacante es: '. $this->vacancy_title)
                    ->action('Ver Notificaciones', $url)
                    ->line('Gracias por usar DevJobs!');
    }

    //! alamacena las notificaciones en la database., devuelve un array, pero se almacena en ddbb como objeto, columna data
    public function toDatabase($notificable){
       // data para la base de datos, en notifications
        return [
           'vacancy_id' => $this->vacancy_id,
           'user_id' => $this->user_id,
           'vacancy_title' => $this->vacancy_title,
        ];
    }

    /**
     * Get the array representation of the notification.
     *
     * @return array<string, mixed>
    //  */
    // public function toArray(object $notifiable): array
    // {
    //     return [
    //         //
    //     ];
    // }
}
