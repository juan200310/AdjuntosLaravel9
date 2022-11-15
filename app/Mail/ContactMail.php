<?php

namespace App\Mail;

use App\DataTransferObjects\Contact;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactMail extends Mailable
{
    use Queueable, SerializesModels;

    public function __construct(public readonly Contact $contact){}

    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address($this->contact->email, $this->contact->name),
            subject: $this->contact->subject,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.contact',
        );
    }

    public function attachments(): array
    {
        return [
            Attachment::fromData(
                data: fn () => $this->contact->file->getContent(),
                name: $this->contact->file->getClientOriginalName(),
            )
        ];
    }
}
