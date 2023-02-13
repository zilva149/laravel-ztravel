<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    const SORT = [
        'popularity_desc' => 'Populiariausios',
        'price_desc' => 'Brangiausios',
        'price_asc' => 'Pigiausios',
    ];

    protected $fillable = [
        'name',
        'address',
        'image',
        'people_limit',
        'country_id',
        'destination_id',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }
}
