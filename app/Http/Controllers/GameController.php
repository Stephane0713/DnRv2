<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Game;
use App\Reference;

class GameController extends Controller
{
    public function index()
    {
        $games = Game::orderBy('Title')->get(['id', 'Title', 'idPlatform']);

        return view('games.index', ['games' => $games]);
    }

    public function show($id)
    {
        $game = Game::findOrFail($id);

        return view('games.show', ['game' => $game]);
    }

    public function create()
    {
        return view('games.create');
    }

    public function store()
    {
        $game = new Game;

        $game->Title = request('Title');
        $game->ReleaseDate = request('ReleaseDate');
        $game->idPlatform = request('idPlatform');
        $game->idPublisher = request('idPublisher');
        $game->idDeveloper = request('idDeveloper');
        $game->save();


        $genres = request('genres');
        foreach ($genres as $genre) {
            $game->genres()->attach($genre);
        }

        $ref = new Reference();
        $ref->ref = "TEST";
        $game->reference()->save($ref);

        return redirect('/games');
    }

    public function edit($id)
    {
        $game = Game::findOrFail($id);

        return view('games.edit', ['game' => $game]);
    }

    public function update($id)
    {
        $game = Game::find($id);

        $game->Title = request('Title');
        $game->ReleaseDate = request('ReleaseDate');
        $game->idPlatform = request('idPlatform');
        $game->idPublisher = request('idPublisher');
        $game->idDeveloper = request('idDeveloper');
        $game->save();

        $genres = request('genres');

        foreach ($genres as $genre) {
            $game->genres()->sync($genre);
        }

        $ref = Reference::find($id);
        $ref->ref = "TEST";
        $game->reference()->save($ref);

        return redirect('/games');
    }

    public function destroy($id)
    {
        $game = Game::findOrFail($id);
        $game->delete();

        $game->genres()->detach($id);

        return redirect('/games');
    }
}
