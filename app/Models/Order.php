<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'delivery_address',
        'costumer_name',
        'customer_phone_number',
        'customer_email',
        'total_price',
        'is_paid',
    ];

    public function dishes(){
        return $this->belongsToMany(Dishes::class);
    }
}
