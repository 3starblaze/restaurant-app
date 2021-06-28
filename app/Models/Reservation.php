<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_time',
        'end_time',
        'person_count',
        'table_num',
        'description',
        'reserver',
        'phone_number'
    ];

    public function restaurant()
    {
        return $this->belongsTo(Restaurant::class);
    }

    /*
    public function user()
    {
        return $this->belongsTo(User::class);
    }
    */
}
