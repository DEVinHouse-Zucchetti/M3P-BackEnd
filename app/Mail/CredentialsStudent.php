<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;

use Illuminate\Queue\SerializesModels;

class CredentialsStudent extends Mailable
{
    use Queueable, SerializesModels;

    public $student;
    public $password;

    /**
     * Create a new message instance.
     *
     * @return void
     */
    public function __construct($student, $password)
    {
        $this->student = $student;
        $this->password = $password;
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Envio de credências de acesso do estudante',
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            html: 'mails.CredentialsStudentTemplate',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, \Illuminate\Mail\Mailables\Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
