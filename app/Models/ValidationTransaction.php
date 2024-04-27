<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ValidationTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'price',
        'nin',
        'validation_category',
        'validation_purpose',
        'response',
        'status',
        'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}