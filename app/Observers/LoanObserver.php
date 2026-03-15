<?php

namespace App\Observers;

use App\Models\Loan;
use App\Models\Book;
use App\Models\Fine;
use App\Mail\LoanCreatedMail;
use App\Mail\BookReturnedMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Log;

class LoanObserver
{
    /**
     * Handle the Loan "created" event.
     */
    public function created(Loan $loan): void
    {
        // Update book available quantity
        $book = Book::find($loan->book_id);
        if ($book) {
            $book->available_quantity = $book->available_quantity - 1;
            $book->save();
        }

        // Send email notification (queued)
        try {
            Mail::to($loan->member->email)->queue(new LoanCreatedMail($loan));
        } catch (\Exception $e) {
            Log::error('Failed to queue loan created email: ' . $e->getMessage());
        }
    }

    /**
     * Handle the Loan "updated" event.
     */
    public function updated(Loan $loan): void
    {
        // If book is returned, update available quantity
        if ($loan->isDirty('status') && $loan->status == 'returned' && $loan->return_date) {
            $book = Book::find($loan->book_id);
            if ($book) {
                $book->available_quantity = $book->available_quantity + 1;
                $book->save();
            }

            // Check for overdue and create fine if applicable
            if ($loan->due_date < $loan->return_date) {
                $daysOverdue = $loan->due_date->diffInDays($loan->return_date);
                $fineAmount = $daysOverdue * 1.00; // $1 per day

                Fine::create([
                    'loan_id' => $loan->id,
                    'amount' => $fineAmount,
                    'reason' => "Book returned {$daysOverdue} days late"
                ]);
            }

            // Send return confirmation email
            try {
                Mail::to($loan->member->email)->queue(new BookReturnedMail($loan));
            } catch (\Exception $e) {
                Log::error('Failed to queue return email: ' . $e->getMessage());
            }
        }
    }
}
