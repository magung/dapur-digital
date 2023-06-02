<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TransactionType extends Model
{
    use HasFactory;
    protected $primaryKey='transaction_type_id';
    protected $fillable = [
        'transaction_type'
    ];
}
