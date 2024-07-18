<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <title>PokeDex</title>
    </head>
    <body>
        <a href="/"><div>Home page</div></a> 
        <a href="/favorites"><div>Ulubione</div></a> <br><br>
        @yield('content')
    </body>
</html>
