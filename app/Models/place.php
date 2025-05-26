<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class place extends Model
{
    //
    public $timestamps = false;
    protected $fillable = ['name', 'type', 'latitude', 'longitude', 'image', 'open_time', 'x', 'y', 'image_path', 'open_time', 'close_time', 'description'];
}
