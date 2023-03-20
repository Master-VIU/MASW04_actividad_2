<?php

namespace App\Models\tmp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    use HasFactory;

    protected $table = "shopping_cart";
    protected $primaryKey = "shopping_cart_id";

    protected $fillable = [
        'shopping_cart_id',
        'total_cost',
    ];
}
