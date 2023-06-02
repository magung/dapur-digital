<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionProductList extends Model
{
    use HasFactory;
    protected $primaryKey = 'transaction_product_list_id';
    protected $fillable = [
        'transaction_list_id',
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
