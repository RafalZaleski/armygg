@extends('app')

@section('content')
    <form method="get" action="/">
        <input name="search" value="{{ $meta['search'] }}">
        <input type="submit" value="Szukaj"><br><br>
    </form>
    
    @if($meta['currentPage'] === 1)
        Poprzednia strona
    @else
        @if($meta['search'])
            <a href="?search={{ $meta['search'] }}&page={{ $meta['currentPage'] - 1 }}">Poprzednia strona</a>
        @else
            <a href="?page={{ $meta['currentPage'] - 1 }}">Poprzednia strona</a>
        @endif
    @endif

    @if($meta['currentPage'] === $meta['lastPage'])
        Następna strona
    @else
        @if($meta['search'])
            <a href="?search={{ $meta['search'] }}&page={{ $meta['currentPage'] + 1 }}">Następna strona</a>
        @else
            <a href="?page={{ $meta['currentPage'] + 1 }}">Następna strona</a>
        @endif
    @endif

        <br><br>
    @foreach ($pokemons as $pokemon)
        <a href="/{{ $pokemon->name }}">{{ $pokemon->name }}</a><br>
    @endforeach
@endsection