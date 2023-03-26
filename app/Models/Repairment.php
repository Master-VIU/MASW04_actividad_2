<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Repairment extends Model
{
    use HasFactory;

    protected $table = "repairment";
    protected $primaryKey = "repairment_id";

    protected $fillable = [
        'description',
        'request_date',
        'repairment_date',
        'price',
        'staff_id',
        'client_id',
    ];
}
