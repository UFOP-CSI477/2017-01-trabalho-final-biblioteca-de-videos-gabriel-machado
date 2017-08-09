<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Test extends Model
{
    protected $fillable = [
        'date', 'procedure_id', 'user_id'
    ];
}
