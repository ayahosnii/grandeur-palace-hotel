@extends('layouts.back-layout')
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/pages/gallery.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/vendors/css/calendars/fullcalendar.min.css')}}">

    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/plugins/calendars/fullcalendar.css')}}">

@endpush
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"> Rooms </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Rooms
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- DOM - jQuery events table -->
                <section id="dom">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">

                                @include('admin.sections.alerts.success')
                                @include('admin.sections.alerts.errors')

                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <section class="carousel-options">
                                            <div class="row">
                                                <div class="col-md-6 col-sm-12" style="max-width: 100%">
                                                    <div class="card">
                                                        <div class="card-header">
                                                            <h3 class="card-title">
                                                                {{$room -> room_type}} -
                                                                {{$room -> price_per_night}} $ -
                                                                @isset($room->services)
                                                                        @foreach($room->services as $service)
                                                                            <span style="display: inline-block; margin-right: 10px;">
                                                                            <i class="{{$service->icon_class}}"></i>
                                                                            </span>
                                                                        @endforeach
                                                                @endisset
                                                            </h3>
                                                        </div>
                                                        <div class="card-content">
                                                            <div class="card-body">
                                                                <div id="carousel-interval" class="carousel slide" data-ride="carousel" data-interval="5000">
                                                                    <ol class="carousel-indicators">
                                                                        @foreach($room->images as $key => $image)
                                                                            <li data-target="#carousel-interval" data-slide-to="{{ $key }}" class="{{ $key == 0 ? 'active' : '' }}"></li>
                                                                        @endforeach
                                                                    </ol>
                                                                    <div class="carousel-inner" role="listbox">
                                                                        @foreach($room->images as $key => $image)
                                                                            <div class="carousel-item {{ $key == 0 ? 'active' : '' }}">
                                                                                <img src="{{ asset('assets/admin/images/room_images/' . $image->image_path) }}" alt="Slide {{ $key + 1 }}">
                                                                            </div>
                                                                        @endforeach
                                                                    </div>
                                                                    <a class="carousel-control-prev" href="#carousel-interval" role="button" data-slide="prev">
                                                                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                                                        <span class="sr-only">Previous</span>
                                                                    </a>
                                                                    <a class="carousel-control-next" href="#carousel-interval" role="button" data-slide="next">
                                                                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                                                        <span class="sr-only">Next</span>
                                                                    </a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6 col-sm-12" style="max-width: 100%">
                                                    <img src="{{$room->image_url}}">
                                                </div>
                                            </div>
                                        </section>

                                        <div class="row">
                                            <div class="col-12">
                                                <div id="app">
                                                    <h3>Show Booking</h3>
                                                    <calendar-component :room-id="{{ $room->id }}"></calendar-component>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="row">
                                            <div class="col-md-6">
                                                <h3 style="color: #c2a569">Room Information</h3>
                                            </div>
                                            <div class="col-md-6">
                                                <a class="btn btn-primary py-6" style="color: #fff">Edit</a>
                                            </div>
                                        </div>
                                        <table
                                            class="table display nowrap table-striped table-bordered scroll-horizontal">
                                            <thead class="">
                                            <tr>
                                                <th>Attribute</th>
                                                <th>Value</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                     <td>Room type <i class="fa-solid fa-person-shelter"></i></td>
                                                     <td>{{$room -> room_type}}</td>
                                                </tr>
                                                <tr>
                                                     <td>
                                                         price per night
                                                         <i class="fa-solid fa-money-bill-1-wave"></i></td>
                                                     <td>{{$room -> price_per_night}}$</td>
                                                </tr>
                                                <tr>
                                                     <td>
                                                         Room size
                                                         <i class="fa-solid fa-maximize"></i></td>
                                                     <td>{{$room -> size}}$</td>
                                                </tr>
                                            </tbody>
                                        </table>
                                        <div class="justify-content-center d-flex">

                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </div>

@stop
@push('scripts')
    <script src="{{asset('assets/admin/vendors/js/extensions/moment.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/admin/vendors/js/extensions/fullcalendar.min.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/admin/js/scripts/extensions/fullcalendar.js')}}" type="text/javascript"></script>
@endpush
