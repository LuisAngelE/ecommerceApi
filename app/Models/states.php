<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class states extends Model
{
    use HasFactory;

    protected $hidden = ['created_at', 'updated_at'];

    public function municipalities()
    {
        return $this->hasMany(municipalities::class, 'state_id');
    }
}
