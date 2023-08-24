@extends('layouts.front-layout')
@section('content')
    <div id="app">
        <room-details-component :room-id="{{ $room->id }}" />
    </div>

@endsection
