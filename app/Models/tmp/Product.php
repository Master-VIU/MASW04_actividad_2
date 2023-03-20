<?php

namespace App\Models\tmp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    protected $table = "product";
    protected $primaryKey = "product_id";

    protected $fillable = [
        'product_id',
        'categorproduct_idy_id',
        'category_id',
        'name',
        'description',
        'price',
        'properties',
        'stock',
    ];
}
