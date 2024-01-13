<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Transaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'total',
        'brand_id',
        'address',
        'transfer_image',
        'bank_account_id',
        'receipt_number',
        'expedition',
        'is_used',
        'status',
        'comment',
    ];
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function bankAccount()
    {
        return $this->belongsTo(BankAccount::class, 'bank_account_id');
    }
}
