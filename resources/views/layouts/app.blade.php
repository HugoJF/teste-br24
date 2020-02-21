<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Teste - Br24</title>

    <!-- Bootstrap -->
    <link href="{{ mix('css/bootstrap.css') }}" rel="stylesheet">
</head>
<body class="bg-light">
<div class="container">
    @include('flash::message')

    @yield('content')
</div>
<script src="{{ mix('js/app.js') }}"></script>
</body>
</html>
