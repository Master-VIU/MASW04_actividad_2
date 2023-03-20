<?php

namespace App\Models\tmp;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProductImage extends Model
{
    use HasFactory;


    protected $table = "product_image";
    protected $primaryKey = "image_id";

    protected $fillable = [
        'image_id',
        'product_id',
        'image_path',
    ];
}
