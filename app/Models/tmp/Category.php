<?php

namespace App\Models\tmp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = "category";
    protected $primaryKey = "category_id";

    protected $fillable = [
        'category_id',
        'name_category',
    ];
}
