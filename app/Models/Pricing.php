<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Pricing extends Model
{
    use HasFactory;

    protected $fillable = [
        'pricing_category_id',
        'item_name',
        'price'
    ];

    public function pricingCategory()
    {
        return $this->belongsTo(PricingCategory::class);
    }
}
