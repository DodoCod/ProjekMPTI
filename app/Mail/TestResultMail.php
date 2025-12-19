<?php

namespace App\Mail;

use App\Models\Participant;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class TestResultMail extends Mailable
{
    use Queueable, SerializesModels;

    public $participant;

    public function __construct(Participant $participant)
    {
        $this->participant = $participant;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Hasil Skrining Kesehatan Mental DASS-42 Anda',
        );
    }

    public function content(): Content
    {
        return new Content(
            // Merujuk ke resources/views/emails/test-result.blade.php
            markdown: 'emails.test-result', 
            with: [
                'name' => $this->participant->name,
                'result' => $this->participant->result,
            ],
        );
    }
}