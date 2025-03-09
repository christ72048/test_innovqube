<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Model;


class Properties extends Model
{
    protected $fillable = [
        'id',
        'name',
        'description',
        'price_per_night'
    ];

    // Relation avec les réservations
    public function bookings()
    {
        return $this->hasMany(Bookings::class);
    }
}
