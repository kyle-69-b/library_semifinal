<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Loan extends Model
{
    use HasFactory;

    protected $fillable = [
        'loan_number', 'book_id', 'member_id', 'loan_date',
        'due_date', 'return_date', 'status', 'notes'
    ];

    protected $casts = [
        'loan_date' => 'date',
        'due_date' => 'date',
        'return_date' => 'date',
    ];

    public function book()
    {
        return $this->belongsTo(Book::class);
    }

    public function member()
    {
        return $this->belongsTo(Member::class);
    }

    public function fine()
    {
        return $this->hasOne(Fine::class);
    }

    public function isOverdue()
    {
        return !$this->return_date && $this->due_date < now();
    }

    public function calculateFine()
    {
        if ($this->isOverdue()) {
            $daysOverdue = now()->diffInDays($this->due_date);
            return $daysOverdue * 1.00; // $1 per day fine
        }
        return 0;
    }
}
