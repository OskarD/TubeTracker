<?php

namespace TubeTracker\YouTube;

use TubeTracker\User;
use Illuminate\Database\Eloquent\Model;

class Channel extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'id',
        'youtube_id'
    ];

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
}
