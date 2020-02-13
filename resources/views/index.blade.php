@extends('app')

@section('title', 'Galleries')

@section('content')
    <ul>
        @foreach ($galleries as $gallery)
            <li>
                <a href="{{ $gallery }}">{{ $gallery }}</a>
            </li>
        @endforeach
    </ul>
@endsection
