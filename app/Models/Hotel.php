<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Hotel extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'desc',
        'photo',
    ];

    public function country()
    {
        return $this->belongsTo(Country::class);
    }
}
