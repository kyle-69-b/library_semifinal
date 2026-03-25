<?php

namespace App\Observers;

use App\Models\Loan;
use App\Models\Book;
use App\Models\Fine;
use App\Mail\LoanConfirmationMail;
use App\Mail\OverdueNoticeMail;
use Illuminate\Support\Facades\Mail;

class LoanObserver
{
    /**
     * Handle the Loan "created" event.
     */
    public function created(Loan $loan): void
    {
        // Update book inventory (decrease available quantity)
        $book = Book::find($loan->book_id);
        if ($book && $book->available_quantity > 0) {
            $book->available_quantity -= 1;
            $book->save();
        }

        // Send email notification via queue
        Mail::to($loan->member->email)->queue(new LoanConfirmationMail($loan));
    }

    /**
     * Handle the Loan "updated" event.
     */
    public function updated(Loan $loan): void
    {
        // When book is returned
        if ($loan->isDirty('status') && $loan->status == 'returned' && $loan->return_date) {
            // Update inventory (increase available quantity)
            $book = Book::find($loan->book_id);
            if ($book) {
                $book->available_quantity += 1;
                $book->save();
            }

            // Create fine if overdue
            if ($loan->due_date < $loan->return_date) {
                $daysOverdue = $loan->due_date->diffInDays($loan->return_date);
                $fineAmount = $daysOverdue * 1.00;

                Fine::create([
                    'loan_id' => $loan->id,
                    'amount' => $fineAmount,
                    'reason' => "Book returned {$daysOverdue} days late",
                ]);
            }
        }
    }
}
