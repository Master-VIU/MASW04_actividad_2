<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory;

    protected $table = "address";
    protected $primaryKey = "address_id";

    protected $fillable = [
        'address_id',
        'street',
        'street_number',
        'city',
        'postal_code',
    ];
}
