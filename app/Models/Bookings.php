<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Bookings extends Model
{
    protected $fillable = [
        'user_id',
        'property_id',
        'start_date',
        'end_date'
    ];
    
    // Relation avec l'utilisateur
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Relation avec la propriété
    public function properties()
    {
        return $this->belongsTo(Properties::class);
    }
}
