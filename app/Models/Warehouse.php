<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'category',
        'subcategory',
        'code',
        'add_code',
        'quantity',
        'measure',
        'purchase_price',
        'sell_price',
        'purchase_amount',
        'sell_amount',
    ];
}
