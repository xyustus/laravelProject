<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Film extends Model
{
    //
    
    protected $casts = [
        'genres' => 'array'
    ];


    /**
    * Get the comments of the film.
    */
    public function comments()
    {
        return $this->hasMany('App\Comment');
    }
}
