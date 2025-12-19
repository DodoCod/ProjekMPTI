<?php

namespace App\Mail;

use App\Models\Participant;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Queue\SerializesModels;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Support\Facades\Request;

class TestResultMail extends Mailable
{
    public function sendResultEmail(Request $request, Participant $participant)
    {
        return back()->with('info', 'Fitur email sementara dimatikan di production.');
    }
    // use Queueable, SerializesModels;

    // public $participant;

    // public function __construct(Participant $participant)
    // {
    //     $this->participant = $participant;
    // }

    // public function envelope(): Envelope
    // {
    //     return new Envelope(
    //         subject: 'Hasil Skrining Kesehatan Mental DASS-42 Anda',
    //     );
    // }

    // public function content(): Content
    // {
    //     return new Content(
    //         // Merujuk ke resources/views/emails/test-result.blade.php
    //         markdown: 'emails.test-result', 
    //         with: [
    //             'name' => $this->participant->name,
    //             'result' => $this->participant->result,
    //         ],
    //     );
    // }
}