<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $table = "addresses";
    protected $primaryKey = 'address_id';
    protected $fillable = [
        'address',
        'contact_name',
        'contact_phone',
        'customer_id',
        'id',
        'latitude',
        'longitude',
        'name',
        'note',
        'postal_code',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class, 'customer_id');
    }
}
