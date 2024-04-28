<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PersonalizationTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'price',
        'tracking_id',
        'response',
        'response_text',
        'response_pdf',
        'status',
        'user_id',
    ];

    protected $cast = [
        'response_pdf'
    ];
    
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
