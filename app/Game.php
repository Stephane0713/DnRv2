<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Game extends Model
{
    protected $table = 'videogames';
    public $timestamps = false;

    public function platform()
    {
        return $this->hasOne('App\Platform', 'id', 'idPlatform');
    }

    public function publisher()
    {
        return $this->hasOne('App\Publisher', 'id', 'idPublisher');
    }

    public function developer()
    {
        return $this->hasOne('App\Developer', 'id', 'idDeveloper');
    }

    public function genres()
    {
        return $this->belongsToMany('App\Genre', 'gamesgenres', 'idVideoGame', 'idGenre');
    }
}
