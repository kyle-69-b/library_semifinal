<?php

namespace App\Models;

use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Notifications\Notifiable;

class Member extends Authenticatable
{
    use HasFactory, Notifiable;

    protected $fillable = [
        'member_id',
        'name',
        'email',
        'password',
        'phone',
        'address',
        'membership_date',
        'membership_expiry',
        'status',
        'photo',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'membership_date'   => 'date',
        'membership_expiry' => 'date',
    ];

    /**
     * A member has many loans.
     * Uses 'member_id' foreign key on loans table.
     */
    public function loans()
    {
        return $this->hasMany(\App\Models\Loan::class, 'member_id');
    }

    /**
     * Active loans only.
     */
    public function activeLoans()
    {
        return $this->hasMany(\App\Models\Loan::class, 'member_id')
                    ->where('status', 'borrowed');
    }

    /**
     * Overdue loans only.
     */
    public function overdueLoans()
    {
        return $this->hasMany(\App\Models\Loan::class, 'member_id')
                    ->where('status', 'overdue');
    }

    public static function generateMemberId(): string
    {
        $last   = static::latest()->first();
        $number = $last ? (int) substr($last->member_id, 4) + 1 : 1;
        return 'MEM-' . str_pad($number, 4, '0', STR_PAD_LEFT);
    }
}
