@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-body">
                    <p>
                        <a href="{{route('games.index')}}">games/</a>
                    </p>
                    <p>
                        <a href="{{route('games.create')}}">games/create</a>
                    </p>
                    <p>
                        <a href="{{route('games.edit', ['id' => 10])}}">games/10/edit</a>
                    </p>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
