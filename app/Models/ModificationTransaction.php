<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModificationTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'price',
        'nin',
        'tracking_id',
        'modification_type',
        'details_to_modify',
        'surname',
        'firstname',
        'middlename',
        'title',
        'gender',
        'dob',
        'phone',
        'state_of_residence',
        'lga_of_residence',
        'town',
        'address_line_1',
        'address_line_2',
        'profession',
        'passport',
        'state_of_origin',
        'lga_of_origin',
        'religion',
        'response',
        'response_text',
        'response_pdf',
        'status',
        'user_id'
    ];

    protected $casts = [
        'details_to_modify',
        'response_pdf'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
