<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Video extends Model
{
    public function camera() {
        return $this->belongsTo('App\Camera');
    }

    public function frames() {
        return $this->hasMany('App\Frame');
    }

    public function comments() {
        return $this->hasMany('App\VideoComment');
    }

    public function getFirstFrameAttribute() {
        return $this->frames()->orderBy('seq')->first();
    }
}
