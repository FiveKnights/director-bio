<?php

namespace App\Mail;

use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMessage extends Mailable
{
    use SerializesModels;

    public function __construct(public array $data)
    {
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            // Reply goes straight to the visitor; "from" stays your own address
            replyTo: [new Address($this->data['email'], $this->data['name'])],
            subject: 'Portfolio contact: ' . $this->data['name'],
        );
    }

    public function content(): Content
    {
        return new Content(view: 'emails.contact');
    }
}