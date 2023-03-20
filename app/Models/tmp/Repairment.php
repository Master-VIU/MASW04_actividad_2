<?php

namespace App\Models\tmp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repairment extends Model
{
    use HasFactory;

    protected $table = "repairment";
    protected $primaryKey = "repariment_id";

    protected $fillable = [
        'repariment_id',
        'description',
        'request_date',
        'repairment_date',
        'price',
        'staff_id',
        'client_id',
    ];
}
