<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reservation extends Model
{
    use HasFactory;

    protected $fillable = [
        'starttime',
        'endtime',
        'personcount',
        'tablenum',
        'description',
        'reserver',
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
