<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Card extends Model
{
    use HasFactory;

    protected $table = "card";
    protected $primaryKey = "card_id";

    protected $fillable = [
        'card_number',
        'type',
        'cvv',
        'expiration_date',
        'user_client_id',
    ];
}
