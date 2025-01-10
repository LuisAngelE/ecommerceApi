<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class municipalities extends Model
{
    use HasFactory;

    public function state()
    {
        return $this->belongsTo(states::class);
    }
}
