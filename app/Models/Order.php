<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'offer_id',
        'destination_id',
        'hotel_id',
    ];

    const STATUS = [
        'Nepatvirtinta' => 0,
        'Patvirtinta' => 1,
        'Atšaukta' => 2
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }
    
    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function offer()
    {
        return $this->belongsTo(Offer::class);
    }
}
