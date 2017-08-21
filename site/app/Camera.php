<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Camera extends Model
{
    public function videos() {
        return $this->hasMany('App\Video');
    }
}
