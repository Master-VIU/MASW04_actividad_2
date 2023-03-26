<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ClientAddress extends Model
{
    use HasFactory;

    protected $table = "client_address";
    protected $primaryKey = "client_address_id";

    protected $fillable = [
        'client_id',
        'address_id'
    ];
}
