<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Restaurant extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'address', 'description', 'image', 'users_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function dish()
    {
        return $this->hasMany(Dish::class);
    }

    public function types()
    {
        return $this->belongsToMany(Type::class);
    }

    protected $casts = [
        'created_at' => 'datetime:d/m/y H:i',
        'updated_at' => 'datetime:d/m/y H:i:s',
    ];
}
