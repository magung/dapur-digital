<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
        'qty',
        'price',
        'panjang',
        'lebar',
        'total_price',
        'user_id',
        'satuan',
        'finishing_id',
        'cutting_id',
        'finishing_price',
        'cutting_price',
    ];
}
