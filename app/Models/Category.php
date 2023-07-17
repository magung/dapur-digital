<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;
    protected $primaryKey = 'category_id';
    protected $table = "categories";
    protected $fillable = [
        "category_name",
        "satuan"
    ];

    public function products()
    {
        return $this->hasMany(Product::class);
    }

    public function finishings()
    {
        return $this->hasMany(Finishing::class);
    }

    public function cuttings()
    {
        return $this->hasMany(Cutting::class);
    }
}
