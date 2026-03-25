<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Models\Member;
use App\Models\Category;
use App\Models\Book;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Create Admin User
        User::create([
            'name' => 'System Admin',
            'email' => 'admin@library.com',
            'password' => Hash::make('password'),
            'role' => 'admin',
            'email_verified_at' => now(),
        ]);

        // Create Librarian User
        User::create([
            'name' => 'Jane Librarian',
            'email' => 'librarian@library.com',
            'password' => Hash::make('password'),
            'role' => 'librarian',
            'email_verified_at' => now(),
        ]);

        // Create Member with associated member record
        $member = Member::create([
            'member_id' => 'MEM-001',
            'name' => 'John Member',
            'email' => 'member@library.com',
            'phone' => '09123456789',
            'address' => '123 Library Street',
            'membership_date' => now(),
            'membership_expiry' => now()->addYear(),
            'status' => 'active',
        ]);

        User::create([
            'name' => 'John Member',
            'email' => 'member@library.com',
            'password' => Hash::make('password'),
            'role' => 'member',
            'member_id' => $member->id,
            'email_verified_at' => now(),
        ]);

        // Create Categories
        $categories = ['Fiction', 'Non-Fiction', 'Science', 'Technology', 'History', 'Biography'];
        foreach ($categories as $cat) {
            Category::create([
                'name' => $cat,
                'slug' => Str::slug($cat),
                'description' => "Books in the {$cat} category"
            ]);
        }

        // Create Sample Books
        for ($i = 1; $i <= 20; $i++) {
            Book::create([
                'isbn' => 'ISBN' . str_pad($i, 6, '0', STR_PAD_LEFT),
                'title' => "Sample Book Title {$i}",
                'author' => "Author " . chr(64 + ($i % 26 + 1)),
                'publisher' => "Publisher " . rand(1, 5),
                'publication_year' => rand(2000, 2024),
                'category_id' => rand(1, 6),
                'quantity' => rand(2, 8),
                'available_quantity' => rand(1, 6),
                'shelf_location' => "Shelf " . chr(65 + rand(0, 25)) . rand(1, 10)
            ]);
        }
    }
}