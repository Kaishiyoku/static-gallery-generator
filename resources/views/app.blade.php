<!doctype html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <link href="https://fonts.googleapis.com/css2?family=Merriweather:ital,wght@0,300;0,400;0,700;1,300;1,400;1,700&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="/css/app.css">
</head>
<body>

@yield('content')

<script src="/js/app.js"></script>

@yield('scripts')

</body>
</html>
