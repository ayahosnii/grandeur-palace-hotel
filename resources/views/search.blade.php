@extends('layouts.front-layout')
@section('content')
    <div id="app">
        <room-component :ava-room="{{$availableRooms}}"></room-component>
    </div>


@endsection
