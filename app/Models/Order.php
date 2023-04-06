<?php

namespace App\Models;

use Carbon\Carbon;
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

    public function dishes()
    {
        return $this->belongsToMany(Dish::class);
    }

    public function getDate($date_column, $format = 'd-m-Y')
    {
        $date = $this->$date_column;
        return Carbon::create($date)->format($format);
    }

    public function getDateDiff($date_column)
    {
        $date = $this->$date_column;
        return Carbon::parse($date)->diffForHumans();
    }
}
