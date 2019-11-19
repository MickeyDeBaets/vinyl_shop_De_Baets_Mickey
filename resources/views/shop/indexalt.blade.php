@extends('layouts.template')

@section('title', 'Shop')

@section('main')

    <style>
        h2 {
            text-transform: capitalize;
        }
    </style>
    <h1>Shop but simple.</h1>
    <hr>
    @foreach($genres as $genre)
        <h2>{{$genre->name}}</h2>
        <ul>
        @foreach($genre->records as $record)

            <li><a href="/shop/{{$record->id}}">{{$record->artist}} - {{$record->title}}</a> | Price: €{{ number_format($record->price,2) }} | Stock: {{$record->stock}}</li>

        @endforeach
        </ul>
    @endforeach


@endsection
