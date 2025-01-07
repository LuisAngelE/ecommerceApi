<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reviews extends Model
{
    use HasFactory;
    protected $fillable = ['product_id', 'user_id', 'order_id', 'rating', 'comment', 'approved'];

    // Relación: una reseña pertenece a un producto
    public function product()
    {
        return $this->belongsTo(Products::class, 'product_id');
    }

    // Relación: una reseña pertenece a un usuario
    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // Relación: una reseña pertenece a un pedido
    public function order()
    {
        return $this->belongsTo(orders::class, 'order_id');
    }
}
