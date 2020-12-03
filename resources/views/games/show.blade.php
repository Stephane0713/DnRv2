@extends('layouts.app')

@section('content')
<div class="container">
{{$test}}
    <div class="card card-body mb-2">
        {{$game->Title}} -
        {{$game->ReleaseDate}} -
        {{$game->platform->name}} -
        {{$game->publisher->name}} -
        {{$game->developer->name}} -
        @foreach($game->genres as $genre)
        {{$genre->name}} -
        @endforeach
    </div>
</div>
@endsection
