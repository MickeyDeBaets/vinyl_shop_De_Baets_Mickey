@extends('layouts.template')

@section('title', 'Welcome to The Vinyl Shop')

@section('main')
    <h1>Records</h1>
    <ul>
        @foreach ($records as $record)
            <li>{!! $record !!}</li>
        @endforeach
    </ul>
@endsection

{{--<ul>--}}
{{--    @foreach ($records as $record)--}}
{{--        <li>{{ $record }}</li>--}}
{{--    @endforeach--}}
{{--</ul>--}}
