@extends('app')

@section('content')
    
    @foreach ($pokemons as $pokemon)
       {{ $pokemon }}<br>
    @endforeach
@endsection