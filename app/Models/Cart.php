<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $primaryKey = 'cart_id';
    protected $fillable = [
        'product_id',
        'qty',
        'price',
        'panjang',
        'lebar',
        'total_price',
        'customer_id',
        'satuan',
        'finishing_id',
        'cutting_id',
        'finishing_price',
        'cutting_price',
        'file',
        'luas',
        'user_id'
    ];

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
