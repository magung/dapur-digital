<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Finishing extends Model
{
    use HasFactory;
    protected $primaryKey = 'finishing_id';
    protected $fillable = [
        'finishing',
        'finishing_price'
    ];
}
