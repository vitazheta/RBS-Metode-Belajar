<?php

namespace App\Notifications;

use Illuminate\Auth\Notifications\ResetPassword as ResetPasswordNotification;
use Illuminate\Notifications\Messages\MailMessage;

class CustomResetPassword extends ResetPasswordNotification
{
    /**
     * Get the mail representation of the notification.
     */
    public function toMail($notifiable): MailMessage
    {
        return (new MailMessage)
                    ->subject('Reset Password EdVise Anda') // <-- Ganti subjek
                    ->greeting('Halo, Dosen!') // <-- Ganti greeting
                    ->line('Anda menerima email ini karena kami menerima permintaan reset password untuk akun Anda.') // <-- Ganti baris pertama
                    ->action('Reset Password Anda', url(config('app.url').route('password.reset', $this->token, false)))
                    ->line('Link reset password ini akan kedaluwarsa dalam ' . config('auth.passwords.dosens.expire') . ' menit.') // <-- Ganti baris kedaluwarsa
                    ->line('Jika Anda tidak meminta reset password, tidak ada tindakan lebih lanjut yang diperlukan.') // <-- Ganti baris penutup
                    ->salutation('Hormat kami, EdVise'); // <-- Ganti salutation
    }
}
