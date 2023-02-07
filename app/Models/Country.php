<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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
        'photo',
    ];

    public function hotels()
    {
        return $this->hasMany(Hotel::class);
    }
}
