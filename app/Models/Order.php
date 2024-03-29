<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = "order";
    protected $primaryKey = "order_id";

    protected $fillable = [
        'price',
        'order_date',
        'shipping_date',
        'location',
        'card_id',
        'address_id',
        'client_id',
        'shopping_cart_id',
    ];
}
