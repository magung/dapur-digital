<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
class Customer extends Authenticatable
{
    use HasFactory, Notifiable;
    protected $primaryKey = 'customer_id';
    protected $fillable = [
        'name', 'email', 'password', 'phone_number', 'gender', 'birthday', 'address', 'photo', 'status', 'store_id'
    ];
    protected $hidden = [
        'password'
    ];

    public function cart()
    {
        return $this->hasMany(Cart::class, 'customer_id');
    }

    public function addresses()
    {
        return $this->hasMany(Location::class, 'customer_id');
    }

}
