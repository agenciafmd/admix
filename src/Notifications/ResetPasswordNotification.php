<?php

namespace Agenciafmd\Admix\Notifications;

use Illuminate\Notifications\Channels\MailChannel;
use Illuminate\Notifications\Notification;
use Illuminate\Notifications\Messages\MailMessage;

class ResetPasswordNotification extends Notification
{
    public string $token;

    public function __construct(string $token)
    {
        $this->token = $token;
    }

    public function via($notifiable): array
    {
        return [
            MailChannel::class,
        ];
    }

    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage())
            ->markdown('admix-mail::markdown.email')
            ->theme('admix-mail::theme.tabler')
            ->subject(config('app.name') . ' | ' . __('Forgot password'))
            ->level('default')
            ->greeting(__('Forgot password'))
            ->line(__('You recently requested to reset a password for your account. Use the button below to reset it. This message will expire in 24 hours.'))
            ->action(__('Reset password'), route('admix.auth.resetPassword', $this->token))
            ->line(__('If you didn\'t request a password reset, please ignore this message or contact us if you have any questions.'));
    }
}
