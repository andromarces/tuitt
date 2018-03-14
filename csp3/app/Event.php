<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    public function user()
    {
        return $this->belongsTo("App\User");
    }

    function comment() {
        return $this->hasMany("App\Comment");
    }
}
