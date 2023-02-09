<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'desc',
        'image',
        'country_id'
    ];

    protected function image(): Attribute
    {
        return Attribute::make(get: function($value) {
            return $value ? "/storage/hotels/$value" : '/assets/img/logo.png';
        });
    }

    public function country()
    {
        return $this->belongsTo(Country::class);
    }

    public function travels()
    {
        return $this->hasMany(Travel::class);
    }
}
