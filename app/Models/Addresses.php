<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Addresses extends Model
{
    use HasFactory;

    // Los atributos que se pueden asignar masivamente
    protected $fillable = [
        'address_line_1',
        'address_line_2',
        'zip_code',
        'colony',
        'street_name',
        'numero_int',
        'numero_ext',
        'phone_number',
        'is_default',
        'user_id',
        'state_id',
        'municipality_id',

    ];

    /**
     * Relación con el modelo User.
     * Cada dirección pertenece a un usuario.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function state()
    {
        return $this->belongsTo(states::class);
    }

    public function municipality()
    {
        return $this->belongsTo(municipalities::class);
    }
}
