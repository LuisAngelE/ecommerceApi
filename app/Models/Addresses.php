<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addresses extends Model
{
    use HasFactory;

    // Los atributos que se pueden asignar masivamente
    protected $fillable = [
        'user_id',
        'address_line_1',
        'address_line_2',
        'city',
        'state',
        'zip_code',
        'country',
        'phone_number',
        'is_default'
    ];

    /**
     * Relación con el modelo User.
     * Cada dirección pertenece a un usuario.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
