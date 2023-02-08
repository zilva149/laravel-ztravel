<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Travel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'travel_start',
        'travel_end',
        'price',
        'country_id',
        'hotel_id',
    ];

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
