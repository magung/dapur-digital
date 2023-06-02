<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cutting extends Model
{
    use HasFactory;
    protected $primaryKey = 'cutting_id';
    protected $fillable = [
        'cutting',
        'cutting_price'
    ];
}
