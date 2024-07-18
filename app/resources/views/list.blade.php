@extends('app')

@section('content')
    
    @foreach ($pokemons as $pokemon)
        <a href="/{{ $pokemon->name }}">{{ $pokemon->name }}</a><br>
    @endforeach
@endsection