<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Country extends Model
{
    use HasFactory;

    const CONTINENTS = [
        'Europa',
        'Azija',
        'Afrika',
        'Pietų Amerika',
        'Šiaurės Amerika',
        'Antarktida',
        'Okeanija',
    ];

    protected $fillable = [
        'name',
        'continent',
        'season_start',
        'season_end',
    ];

    public function destinations()
    {
        return $this->hasMany(Destination::class);
    }

    public function offers()
    {
        return $this->hasMany(Offer::class);
    }
}
