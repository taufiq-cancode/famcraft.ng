<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PUKTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'price',
        'user_id',
        'phone',
        'fullname',
        'dob',
        'status',
        'response',
        'response_text',
        'response_pdf',
    ];

    protected $cast = [
        'response_pdf'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    
}
