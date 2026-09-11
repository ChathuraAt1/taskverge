<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactInquiryReceived extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(
        public array $inquiry
    ) {}

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'New Contact Inquiry: ' . ($this->inquiry['subject'] ?? 'TaskVerge Website Message'),
            replyTo: [
                new \Illuminate\Mail\Mailables\Address($this->inquiry['email'], $this->inquiry['name'])
            ]
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact-inquiry',
        );
    }

    public function attachments(): array
    {
        return [];
    }
}
