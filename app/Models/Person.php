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
        'person_id',
        'dni',
        'name',
        'surname',
        'email',
        'telephone',
    ];
}
