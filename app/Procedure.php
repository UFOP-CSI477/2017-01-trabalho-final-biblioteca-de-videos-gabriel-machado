<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Procedure extends Model
{
    protected $fillable = [
        'name', 'price'
    ];

    public function tests() {
        return $this->hasMany('App\Test');
    }
}
