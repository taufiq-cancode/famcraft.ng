<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewEnrollmentTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
        'transaction_id',
        'price',
        'user_id',
        'type',
        'surname',
        'firstname',
        'middlename',
        'gender',
        'dob',
        'country_of_birth',
        'nationality',
        'nin',
        'town',
        'country_of_residence',
        'state_of_residence',
        'lga_of_residence',
        'address_line_1',
        'address_line_2',
        'zipcode',
        'country_of_origin',
        'state_of_origin',
        'lga_of_origin',
        'phone',
        'email',
        'height',
        'parent_surname',
        'parent_firstname',
        'parent_nin',
        'image',
        'left_finger',
        'right_finger',
        'thumb_finger',
        'response_text',
        'response_pdf',
        'response',
        'status'
    ];

    protected $casts = [
        'response_pdf'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
