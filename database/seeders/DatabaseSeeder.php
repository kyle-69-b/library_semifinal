<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Category;
use App\Models\Book;
use App\Models\Member;
use App\Models\Loan;
use App\Models\Fine;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run()
    {
        // Create admin user
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@library.com',
            'password' => Hash::make('password'),
            'email_verified_at' => now(),
        ]);

        // Create categories
        $categories = [
            'Fiction',
            'Non-Fiction',
            'Science',
            'Technology',
            'History',
            'Biography',
            'Children\'s Books',
            'Reference'
        ];

        foreach ($categories as $cat) {
            Category::create([
                'name' => $cat,
                'slug' => Str::slug($cat),
                'description' => "Books in the {$cat} category"
            ]);
        }

        // Create sample books
        for ($i = 1; $i <= 50; $i++) {
            Book::create([
                'isbn' => 'ISBN' . str_pad($i, 8, '0', STR_PAD_LEFT),
                'title' => "Book Title {$i}",
                'author' => "Author " . chr(64 + ($i % 26 + 1)),
                'publisher' => "Publisher " . rand(1, 10),
                'publication_year' => rand(2000, 2024),
                'category_id' => rand(1, 8),
                'quantity' => rand(2, 10),
                'available_quantity' => rand(1, 8),
                'shelf_location' => "Shelf " . chr(65 + rand(0, 25)) . rand(1, 20)
            ]);
        }

        // Create members
        for ($i = 1; $i <= 30; $i++) {
            Member::create([
                'member_id' => 'MEM' . str_pad($i, 5, '0', STR_PAD_LEFT),
                'name' => "Member {$i}",
                'email' => "member{$i}@example.com",
                'phone' => '555-' . str_pad(rand(0, 999), 3, '0', STR_PAD_LEFT) . '-' . str_pad(rand(0, 9999), 4, '0', STR_PAD_LEFT),
                'address' => "{$i} Library Street, Book City",
                'membership_date' => now()->subMonths(rand(1, 24)),
                'membership_expiry' => now()->addMonths(rand(6, 24)),
                'status' => rand(0, 10) > 1 ? 'active' : 'inactive'
            ]);
        }

        // Create loans
        for ($i = 1; $i <= 100; $i++) {
            $loanDate = now()->subDays(rand(1, 60));
            $dueDate = (clone $loanDate)->addDays(14);
            $status = rand(0, 10);

            if ($status < 6) {
                $status = 'active';
                $returnDate = null;
            } elseif ($status < 9) {
                $status = 'returned';
                $returnDate = (clone $loanDate)->addDays(rand(5, 13));
            } else {
                $status = 'overdue';
                $returnDate = null;
                $dueDate = now()->subDays(rand(1, 10));
            }

            $loan = Loan::create([
                'loan_number' => 'LN-' . strtoupper(Str::random(8)),
                'book_id' => rand(1, 50),
                'member_id' => rand(1, 30),
                'loan_date' => $loanDate,
                'due_date' => $dueDate,
                'return_date' => $returnDate,
                'status' => $status,
                'notes' => rand(0, 1) ? 'Sample note for this loan' : null
            ]);

            // Create fines for overdue loans
            if ($status == 'overdue' || ($status == 'returned' && $returnDate > $dueDate)) {
                $daysOverdue = $returnDate ? $dueDate->diffInDays($returnDate) : now()->diffInDays($dueDate);
                $fineAmount = $daysOverdue * 1.00;

                Fine::create([
                    'loan_id' => $loan->id,
                    'amount' => $fineAmount,
                    'paid_amount' => rand(0, 10) > 7 ? $fineAmount : 0,
                    'status' => rand(0, 10) > 7 ? 'paid' : 'pending',
                    'reason' => "Book returned {$daysOverdue} days late"
                ]);
            }
        }
    }
}
