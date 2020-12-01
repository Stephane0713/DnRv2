<form action="{{ route('games.store') }}" method="POST">
    @csrf
    @isset($game)
    @method('PUT')
    @endisset
    <div class="form-group">
        <label for="title">Titre</label>
        <input class="form-control" type="text" name="Title" id="title" value="{{$game->Title ?? ''}}">
    </div>
    <div class="form-group">
        <label for="date">Date de sortie</label>
        <input class="form-control" type="text" name="ReleaseDate" id="date" value="{{$game->ReleaseDate ?? ''}}">
    </div>
    <div class="form-group">
        <label for="platform">Plateforme</label>
        <select class="form-control" id="platform" name="idPlatform">
            @foreach($platforms as $platform)
            <option value="{{$platform->id}}" {{ isset($game) ? ($platform->id == $game->idPlatform ? 'selected' : '') : '' }}>{{$platform->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="publisher">Éditeur</label>
        <select class="form-control" id="publisher" name="idPublisher">
            @foreach($publishers as $publisher)
            <option value="{{$publisher->id}}" {{ isset($game) ? ($publisher->id == $game->idPublisher ? 'selected' : '') : '' }}>{{$publisher->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label for="developer">Développeur</label>
        <select class="form-control" id="developer" name="idDeveloper">
            @foreach($developers as $developer)
            <option value="{{$developer->id}}" {{ isset($game) ? ($developer->id == $game->idDeveloper ? 'selected' : '') : '' }}>{{$developer->name}}</option>
            @endforeach
        </select>
    </div>

    <div class="mb-3">Genres</div>
    <fieldset>
        @foreach($genres as $genre)
        <div class="form-group form-check">
            <input class="form-check-input" type="checkbox" name="genres[]" id="genre-{{$genre->id}}" value="{{$genre->id}}" {{ isset($game) ? (in_array($genre->id, $checkedGenres) ? 'checked' : '') : '' }}>
            <label class="form-check-label" for="genre-{{$genre->id}}">{{$genre->name}}</label>
        </div>
        @endforeach
    </fieldset>
    @if(isset($game))
    <input class="btn btn-warning" type="submit" value="Modifier">
    @else
    <input class="btn btn-success" type="submit" value="Créer">
    @endif
</form>