<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Platform extends Model
{
    protected $table = 'platform';

    public function game()
    {
        return $this->belongsTo('App\Game', 'id', 'idPlatform');
    }
}
