<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Type extends Model
{
    use HasFactory;

    public function restaurants()
    {
        return $this->belongsToMany(Restaurant::class);
    }

    protected $casts = [
        'created_at' => 'datetime:d/m/y H:i',
        'updated_at' => 'datetime:d/m/y H:i:s',
    ];
}
