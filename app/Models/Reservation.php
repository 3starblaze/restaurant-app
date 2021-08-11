<?php

namespace App\Models;

use App\Misc\UsesUuid;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory, UsesUuid;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'start_time',
        'end_time',
        'max_person_count',
        'description',
        'restaurant_id'
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     *
     */
    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    public function booking()
    {
        return $this->hasOne(Booking::class);
    }

    /**
     * Return reservation duration.
     *
     * @return string
     */
    public function getDurationAttribute()
    {
        return $this['start_time']->diff($this['end_time'])->format('%hh%Im');
    }
}
