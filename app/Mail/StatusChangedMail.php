<?php

namespace App\Mail;

use App\Models\Ticket;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class StatusChangedMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public Ticket $ticket,
        public string $oldStatus
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Bilieto #' . $this->ticket->id . ' statusas pasikeitė',
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.status-changed',
        );
    }
}