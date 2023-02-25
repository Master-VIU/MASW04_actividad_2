<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserClient extends Model
{
    use HasFactory;


    protected $table = "user_client";
    protected $primaryKey = "user_client_id";

    protected $fillable = [
        'user_client_id',
        'shopping_cart_id',
    ];
}
