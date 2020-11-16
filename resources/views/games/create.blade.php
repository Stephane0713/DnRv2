@extends('layouts.app')

@section('content')
<div class="container">
    <div class="card card-body mb-2">
        <form action="{{ route('games.store') }}" method="POST">
            @csrf
            <input type="text" name="Title" value="test">
            <input type="text" name="ReleaseDate" value="test">
            <input type="text" name="idPlatform" value="1">
            <input type="text" name="idPublisher" value="1">
            <input type="text" name="idDeveloper" value="1">
            <input type="text" name="genres[]" value="1">
            <input type="submit" value="test">
        </form>
        @include('games.inc.form')
    </div>
</div>
@endsection
