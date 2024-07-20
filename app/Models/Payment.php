<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{
    use HasFactory;

    protected $fillable = [
        'trxref',
        'reference',
        'user_id',
        'amount',
        'payment_for',
        'payment_type',
        'screenshot',
        'status',
        'remark'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
