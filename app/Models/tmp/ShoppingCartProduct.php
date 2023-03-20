<?php

namespace App\Models\tmp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCartProduct extends Model
{
    use HasFactory;


    protected $table = "shopping_cart_product";
    protected $primaryKey = "shopping_cart_product_id";

    protected $fillable = [
        'shopping_cart_product_id',
        'shopping_cart_id',
        'product_id',
        'quantity',
    ];
}
