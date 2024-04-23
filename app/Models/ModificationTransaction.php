<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ModificationTransaction extends Model
{
    use HasFactory;

    protected $fillable = [
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
        'religion',
        'response',
        'status',
        'user_id'
    ];

    protected $casts = [
        'details_to_modify'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
