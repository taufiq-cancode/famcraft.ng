<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerificationTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'price',
        'method',
        'slip_type',
        'nin',
        'surname',
        'firstname',
        'gender',
        'dob',
        'phone',
        'user_id',
    ];
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}



