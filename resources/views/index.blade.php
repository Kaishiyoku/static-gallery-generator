<!doctype html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>Galleries</title>
</head>
<body>

<ul>
    @foreach ($galleries as $gallery)
        <li>
            <a href="{{ $gallery }}">{{ $gallery }}</a>
        </li>
    @endforeach
</ul>

</body>
</html>
