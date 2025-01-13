<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Roles extends Model
{
    use HasFactory;

    // Campos asignables masivamente
    protected $fillable = ['name', 'description'];

    // Relación: Un rol puede tener muchos usuarios
    public function users()
    {
        return $this->hasMany(User::class);
    }
}
