<?php

namespace App\Http\Controllers;

use App\Game;
use App\Genre;
use App\Platform;
use App\Publisher;
use App\Developer;
use Illuminate\Http\Request;

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
        $platforms = Platform::all();
        $publishers = Publisher::all();
        $developers = Developer::all();
        $genres = Genre::all();

        return view('games.create', [
            'platforms' => $platforms,
            'publishers' => $publishers,
            'developers' => $developers,
            'genres' => $genres
        ]);
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

        return redirect('/games');
    }

    public function edit($id)
    {
        $game = Game::findOrFail($id);
        $checkedGenres = $game->genres->pluck('id')->toArray();
        $platforms = Platform::all();
        $publishers = Publisher::all();
        $developers = Developer::all();
        $genres = Genre::all();

        return view('games.edit', [
            'game' => $game,
            'checkedGenres' => $checkedGenres,
            'platforms' => $platforms,
            'publishers' => $publishers,
            'developers' => $developers,
            'genres' => $genres
        ]);
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

        return redirect('/games');
    }

    public function destroy($id)
    {
        $game = Game::findOrFail($id);
        $game->delete();

        $game->genres()->detach($id);

        return redirect('/games');
    }

    public function resetAllReferences()
    {

        $plaforms = Platform::all();

        foreach ($plaforms as $platform) {

            $list = [];
            $games = Game::where('idPlatform', $platform->id)->get();

            $prefix = $platform->prefix;
            $counter = 1;

            foreach ($games as $game) {

                $suffix = "A";
                $counter = str_pad($counter, 3, '0', STR_PAD_LEFT);

                if (array_search($game->Title, $list)) {
                    $reference = array_key_last($list, $game->Title);
                    $reference++;
                } else {
                    $reference = $prefix . $counter . $suffix;
                    $counter++;
                }
                $list[$reference] = $game->Title;
                $game->reference = $reference;
                $game->save();
            }
        }
    }
}
