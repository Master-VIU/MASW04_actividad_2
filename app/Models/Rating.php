<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    protected $table = "rating";
    protected $primaryKey = "rating_id";

    protected $fillable = [
        'rating_id',
        'rate',
        'opinion',
        'date',
        'user_client_id',
        'product_id',
    ];


}
