<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Frame extends Model
{
    public function video() {
        return $this->belongsTo('App\Video');
    }
}
