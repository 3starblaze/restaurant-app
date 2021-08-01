<?php

namespace App\Models;

use App\Misc\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory, UsesUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'phone_number',
        'notes',
        'reservation_id'
    ];

    public function reservation()
    {
        return $this->belongsTo(Reservation::class);
    }
}
