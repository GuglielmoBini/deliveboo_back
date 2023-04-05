<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dish extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'description', 'image', 'price', 'is_visible'];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function orders()
    {
        return $this->belongsToMany(Order::class);
    }

    protected $casts = [
        'created_at' => 'datetime:d/m/y H:i',
        'updated_at' => 'datetime:d/m/y H:i:s',
    ];
}
