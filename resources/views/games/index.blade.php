@extends('layouts.app')

@section('content')
<div class="container">
    @foreach($games as $game)
    <div class="card card-body mb-2">
        <a href="{{route('games.show', ['id' => $game->id])}}">{{$game->Title}}</a>
        {{$game->platform->name}}
    </div>
    @endforeach
</div>
@endsection
