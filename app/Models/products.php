<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class products extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'price', 'category_id'];

    // Relación: un producto pertenece a una categoría
    public function categories()
    {
        return $this->belongsTo(Categories::class, 'category_id');
    }

    // Relación polimórfica: un producto pertenece a muchas imagenes
    public function images()
    {
        return $this->morphMany(Image::class, 'imageable');
    }

    // Relación: un producto tiene muchas reseñas
    public function reviews()
    {
        return $this->hasMany(Reviews::class, 'product_id');
    }
}
