<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    use HasFactory;

    protected $table = "person";
    protected $primaryKey = "person_id";


    protected $fillable = [
        'dni',
        'name',
        'surname',
        'email',
        'telephone',
        'user_id'
    ];
}
