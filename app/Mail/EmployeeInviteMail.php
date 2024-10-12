<?php

namespace App\Mail;

use App\Models\Admin;
use App\Models\Company;
use App\Models\Invitation;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Mail\Mailables\Address;
use Illuminate\Queue\SerializesModels;

class EmployeeInviteMail extends Mailable
{
    use Queueable, SerializesModels;

    public $invitation;
    public $company; // Add company property
    public $admin; // Add admin property


    /**
     * Create a new message instance.
     */
    public function __construct(Invitation $invitation, Company $company, Admin $admin)
    {
        $this->invitation = $invitation;
        $this->company = $company; // Set the company
        $this->admin = $admin; // Set the admin
    }

    /**
     * Get the message envelope.
     */
    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Invitation to Join ' . $this->company->name,
            from: new Address('admin@illizeo.com', 'Illizeo Admin')
        );
    }

    /**
     * Get the message content definition.
     */
    public function content(): Content
    {
        return new Content(
            view: 'mail.invite',
            with: [
                'company' => $this->company->name, // Use company from the constructor
                'admin_name' => $this->admin->fullName, // Use admin from the constructor
                'inviteUrl' => route('invite.validate', ['token' => $this->invitation->token]),
                'logo_url' => 'assets/media/logos/logo-illizeo.png', // Update this with your actual logo path
            ],
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
