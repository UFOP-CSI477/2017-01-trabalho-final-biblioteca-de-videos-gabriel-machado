<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class VideoComment extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'user_id', 'video_id', 'text'
    ];

    public function user() {
        return $this->belongsTo('App\User');
    }

    public function video() {
        return $this->belongsTo('App\Video');
    }
}
