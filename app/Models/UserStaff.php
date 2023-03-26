<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserStaff extends Model
{
    use HasFactory;

    protected $table = "user_staff";
    protected $primaryKey = "user_staff_id";


    protected $fillable = [
        'role',
        'user_id'
    ];
}
