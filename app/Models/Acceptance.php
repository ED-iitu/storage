<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Acceptance extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'code',
        'quantity',
        'remaining_quantity',
        'invoice_price',
        'markup',
        'selling_price',
        'discount',
        'price_with_discount',
        'total',
    ];
}
