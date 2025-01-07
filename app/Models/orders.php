<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class orders extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'address_id', 'shipping_method_id', 'total', 'status'];

    // Relación: un pedido tiene muchas reseñas
    public function reviews()
    {
        return $this->hasMany(Reviews::class, 'order_id');
    }
}
