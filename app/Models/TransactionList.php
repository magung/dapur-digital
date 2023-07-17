<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionList extends Model
{
    use HasFactory;
    protected $primaryKey = 'transaction_list_id';
    protected $fillable = [
        'store_id',
        'transaction_type_id',
        'transaction_status_id',
        'payment_method_id',
        'payment_status_id',
        'user_id',
        'final_price',
        'bukti_pembayaran',
        'created_by',
        'updated_by',
        'customer_id',
        'address_id',
        'courier_id',
        'courier_price',
    ];

    public function store()
    {
        return $this->belongsTo(Store::class, 'store_id');
    }

    public function transaction_type()
    {
        return $this->belongsTo(TransactionType::class, 'transaction_type_id');
    }

    public function transaction_status()
    {
        return $this->belongsTo(TransactionStatus::class, 'transaction_status_id');
    }

    public function payment()
    {
        return $this->belongsTo(Payment::class, 'payment_method_id');
    }

    public function payment_status()
    {
        return $this->belongsTo(PaymentStatus::class, 'payment_status_id');
    }

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function address()
    {
        return $this->belongsTo(Address::class, 'address_id');
    }

    public function courier()
    {
        return $this->belongsTo(Courier::class, 'courier_id');
    }

    public function transaction_product_lists()
    {
        return $this->hasMany(TransactionProductList::class, 'transaction_list_id');
    }
}
