@extends('app')

@section('content')
    Name: {{ $pokemon->name }} <br><br>

    Stats:<br>
    @foreach ($pokemon->stats as $stat)
        {{ $stat->stat->name }}: {{ $stat->base_stat }} <br>
    @endforeach

    <img src="{{ $pokemon->sprites->front_default }}"> <br>

    <a href="/toggle-favorite/{{ $pokemon->name }}"<button>
        @if($isFavorite)
            Usuń z ulubionych
        @else
            Dodaj do ulubionych
        @endif
    </button>
@endsection