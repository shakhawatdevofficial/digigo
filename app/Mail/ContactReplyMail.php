<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Mail\Mailables\Attachment;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class ContactReplyMail extends Mailable implements ShouldQueue
{
    use Queueable, SerializesModels;

    /**
     * Create a new message instance.
     */
    public function __construct(
        public string $replySubject,
        public string $replyMessage,
        public ?string $fromName = null,
        public ?string $fromEmail = null,
        public ?string $recipientName = null,
        public ?string $recipientEmail = null,
        public ?string $originalSubject = null,
        public ?string $originalMessage = null,
        public ?string $originalDate = null,
        public ?int $contactId = null
    ) {
        $this->fromName = $fromName ?: config('mail.from.name', 'DigiGo Customer Support');
        $this->fromEmail = $fromEmail ?: config('mail.from.address', 'support@digigo.com');
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            from: new Address($this->fromEmail, $this->fromName),
            subject: $this->replySubject,
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'emails.contact_reply',
        );
    }

    /**
     * Get the attachments for the message.
     *
     * @return array<int, Attachment>
     */
    public function attachments(): array
    {
        return [];
    }
}
