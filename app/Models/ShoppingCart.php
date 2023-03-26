<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ShoppingCart extends Model
{
    use HasFactory;

    protected $table = 'shopping_cart';
    protected $primaryKey = "shopping_cart_id";
    /**
     * The attributes that are mass assignablse.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'total_cost'     
    ];
}
