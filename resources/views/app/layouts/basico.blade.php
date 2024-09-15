<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{ asset('css/basico.css') }}">
    <title>GDT</title>
</head>
<body>
    <div class="main">
        @include('app.layouts._partials.sidebar')
        <div class="content">
            @component('app.layouts._components.card')
            @yield('conteudo')
            @endcomponent
        </div>
    </div>
    @include('app.layouts._partials.rodape')
</body>
</html>