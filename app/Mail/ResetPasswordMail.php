<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ResetPasswordMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    public function __construct(
        public readonly string $resetLink,
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Permintaan Reset Password',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'mail.reset-password',
        );
    }
}
