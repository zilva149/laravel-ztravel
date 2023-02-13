<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Laravel\Scout\Searchable;

class Offer extends Model
{
    use HasFactory;
    use Searchable;

    const SORT = [
        'popularity_desc' => 'Populiariausios',
        'price_desc' => 'Brangiausios',
        'price_asc' => 'Pigiausios',
    ];

    protected $fillable = [
        'name',
        'travel_start',
        'travel_end',
        'price',
        'country_id',
        'destination_id',
        'hotel_id',
    ];

    public function toSearchableArray()
    {
        return [
            'name' => $this->name,
        ];
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
    
    public function destination()
    {
        return $this->belongsTo(Destination::class);
    }

    public function hotel()
    {
        return $this->belongsTo(Hotel::class);
    }
}
