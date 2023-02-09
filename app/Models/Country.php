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
        'image',
    ];

    protected function image(): Attribute
    {
        return Attribute::make(get: function($value) {
            return $value ? "/storage/countries/$value" : '/assets/img/logo.png';
        });
    }

    public function hotels()
    {
        return $this->hasMany(Hotel::class);
    }

    public function travels()
    {
        return $this->hasMany(Travel::class);
    }
}
