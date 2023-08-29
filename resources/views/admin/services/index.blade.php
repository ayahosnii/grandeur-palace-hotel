@extends('layouts.back-layout')
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/pages/gallery.css')}}">
@endpush
@section('content')
    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title"> Services </h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="{{route('admin.dashboard')}}">Home</a>
                                </li>
                                <li class="breadcrumb-item active">Services
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
                                <div class="card-header">
                                    <h4 class="card-title">  All Services  </h4>
                                    <a href="{{route('admin.services.create')}}" class="btn btn-primary">Create +</a>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <ul class="list-inline mb-0">
                                            <li><a data-action="collapse"><i class="ft-minus"></i></a></li>
                                            <li><a data-action="reload"><i class="ft-rotate-cw"></i></a></li>
                                            <li><a data-action="expand"><i class="ft-maximize"></i></a></li>
                                            <li><a data-action="close"><i class="ft-x"></i></a></li>
                                        </ul>
                                    </div>
                                </div>

                                @include('admin.sections.alerts.success')
                                @include('admin.sections.alerts.errors')

                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <table
                                            class="table display nowrap table-striped table-bordered scroll-horizontal">
                                            <thead class="">
                                            <tr>
                                                <th>Name </th>
                                                <th>Class icon </th>
                                                <th>Display On Homepage </th>
                                                <th>Options</th>
                                            </tr>
                                            </thead>
                                            <tbody>

                                            @isset($services)
                                                @foreach($services as $service)
                                                    <tr>
                                                        <td>{{$service -> name}}</td>
                                                        <td>{{$service -> icon_class}}</td>
                                                        <td>{{$service -> display_on_homepage == 1 ? 'Yes' : 'No'}}</td>
                                                        <td>
                                                            <div class="btn-group" role="group"
                                                                 aria-label="Basic example">

                                                                <a href="{{route('admin.services.edit',$service -> id)}}"
                                                                   class="btn btn-outline-primary btn-min-width box-shadow-3 mr-1 mb-1">Edit</a>


                                                                <a href="{{route('admin.services.delete',$service -> id)}}"
                                                                   class="btn btn-outline-danger btn-min-width box-shadow-3 mr-1 mb-1">Delete</a>

                                                            </div>
                                                        </td>
                                                    </tr>
                                                @endforeach
                                            @endisset


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
