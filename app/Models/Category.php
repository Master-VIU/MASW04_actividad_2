<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $table = 'category';
    protected $primaryKey = "category_id";
    /**
     * The attributes that are mass assignablse.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name_category',
        'parent_category_id',
    ];
}
