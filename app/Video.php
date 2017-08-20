<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    public function frames() {
        return $this->hasMany('App\Frame');
    }

    public function getFirstFrameAttribute() {
        return $this->frames()->orderBy('seq')->first();
    }
}
