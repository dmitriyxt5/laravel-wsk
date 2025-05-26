<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class schedule extends Model
{
    //

    public $timestamps = false;

    protected $fillable = ['from_place_id', 'line', 'to_place_id', 'departure_time', 'arrival_time', 'distance', 'speed'];
    public function from_place_id() {
        return $this->belongsTo(place::class, 'from_place_id');
    }

    public function to_place_id() {
        return $this->belongsTo(place::class, 'to_place_id');
    }
}
