<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionProductList extends Model
{
    use HasFactory;
    protected $fillable = [
        'transaction_id',
        'product_id',
        'qty',
        'panjang',
        'lebar',
        'satuan',
        'price',
        'total_price',
        'finishing_id',
        'cutting_id',
        'finishing_price',
        'cutting_price',
    ];
}
