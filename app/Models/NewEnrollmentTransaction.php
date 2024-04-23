<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class NewEnrollmentTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
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
        'phone',
        'email',
        'height',
        'parent_surname',
        'parent_firstname',
        'parent_nin',
        'image',
        'left_4_fingers',
        'right_4_fingers',
        'thumb_2_fingers'
    ];

    protected $casts = [
        'left_4_fingers',
        'right_4_fingers',
        'thumb_2_fingers'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
