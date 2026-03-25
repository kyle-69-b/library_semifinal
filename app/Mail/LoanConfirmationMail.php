<?php

namespace App\Mail;

use App\Models\Loan;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Mail\Mailables\Content;
use Illuminate\Mail\Mailables\Envelope;
use Illuminate\Queue\SerializesModels;

class LoanConfirmationMail extends Mailable
{
    use Queueable, SerializesModels;

    public $loan;

    public function __construct(Loan $loan)
    {
        $this->loan = $loan;
    }

    public function envelope(): Envelope
    {
        return new Envelope(
            subject: 'Book Loan Confirmation - ' . $this->loan->loan_number,
        );
    }

    public function content(): Content
    {
        return new Content(
            view: 'emails.loan-confirmation',
        );
    }
}
