<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SearchHistory extends Model
{
    //
    protected $fillable = ['count', 'user_id', 'place_id'];
}
