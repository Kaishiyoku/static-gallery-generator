<!doctype html>
<html lang="de">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>{{ $galleryInfo->name }}</title>
</head>
<body>

@foreach ($files as $file)
    <div>
        <img src="/{{ $file }}"/>
    </div>
@endforeach

</body>
</html>
