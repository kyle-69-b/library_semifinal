<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Member extends Model
{
    use HasFactory;

    protected $fillable = [
        'member_id', 'name', 'email', 'phone', 'address',
        'membership_date', 'membership_expiry', 'status', 'photo'
    ];

    protected $casts = [
        'membership_date' => 'date',
        'membership_expiry' => 'date',
    ];

    public function loans()
    {
        return $this->hasMany(Loan::class);
    }

    public function activeLoans()
    {
        return $this->loans()->whereIn('status', ['active', 'overdue'])->get();
    }

    public function fines()
    {
        return $this->hasManyThrough(Fine::class, Loan::class);
    }

    public function totalFines()
{
    return $this->fines()
        ->where('fines.status', 'pending') // Specify the table name
        ->sum('amount');
}
}
