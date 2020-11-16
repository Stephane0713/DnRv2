<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Reference extends Model
{
    protected $table = 'references';
    protected $primaryKey = 'videogame_id';
    public $timestamps = false;
}
