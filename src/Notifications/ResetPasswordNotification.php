<?php

namespace Agenciafmd\Admix\Notifications;

use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends Notification
{
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
        return (new MailMessage())
            ->subject(config('app.name') . ' | Recuperação de senha')
            ->markdown('agenciafmd/admix::markdown.email')
            ->line('Enviamos este email para você porque foi solicitado a alteração de senha da sua conta.')
            ->action('Alterar Senha', url(config('app.url') . route('admix.recover.reset.form', $this->token, false)))
            ->line('Caso não tenha sido você que solicitou a alteração, por favor, ignore este email.');
    }
}
