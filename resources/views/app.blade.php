<!doctype html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap">

    <link rel="stylesheet" href="{{ mix('css/app.css') }}">
</head>
<body class="antialiased font-serif bg-gray-900 text-gray-100">

@yield('content')

<script src="{{ mix('js/app.js') }}"></script>

@yield('scripts')

</body>
</html>
