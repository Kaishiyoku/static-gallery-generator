<!doctype html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>@yield('title')</title>

    <link rel="stylesheet" href="/css/app.css">
</head>
<body>

@yield('content')

<script src="/js/app.js"></script>

@yield('scripts')

</body>
</html>
