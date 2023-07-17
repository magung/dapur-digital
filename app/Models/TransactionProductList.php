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
        'file',
        'luas'
    ];

    public function transaction_list()
    {
        return $this->belongsTo(TransactionList::class, 'transaction_list_id');
    }

    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    public function finishing()
    {
        return $this->belongsTo(Finishing::class, 'finishing_id');
    }

    public function cutting()
    {
        return $this->belongsTo(Cutting::class, 'cutting_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
