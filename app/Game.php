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

    public function createReferences($game) {
        $games = Game::where('idPlatform', $game->idPlatform)->get('Title', 'Reference')->groupBy('Title');
        $titles = $games;
        if(in_array($game->Title, $titles->toArray())) {
            $reference = 'TEST';
            $reference++;

        } else {
            $prefix = $game->platform->prefix;

            $counter = count($games);
            $counter++;
            $counter = str_pad($counter, 3, '0', STR_PAD_LEFT);

            $suffix = "A";

            $reference = $prefix . $counter . $suffix;
        }
        return $titles;
    }
}
