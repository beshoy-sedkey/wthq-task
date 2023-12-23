<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriceModifier extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'user_type',
        'is_percentage',
        'value',
    ];

}
