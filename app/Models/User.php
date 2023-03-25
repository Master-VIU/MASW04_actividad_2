<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class User extends Model
{
    use HasFactory;


    protected $table = 'user';
    protected $primaryKey = "user_id";
    /**
     * The attributes that are mass assignablse.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'username',
        'password',
    ];

}
