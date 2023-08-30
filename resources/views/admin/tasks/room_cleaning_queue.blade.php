@extends('layouts.back-layout')
@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">Home </a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{route('admin.jobs')}}"> الاقسام
                                        Home </a>
                                </li>
                                <li class="breadcrumb-item active"> أضافه وظيفة
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
            <div class="content-body">
                <!-- Basic form layout section start -->
                <section id="basic-form-layouts">
                    <div class="row match-height">
                        <div class="col-md-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title" id="basic-layout-form"> أضافة وظيفة </h4>
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
                                    <div class="card-body">
                                        <h1>Room Cleaning Queue</h1>

                                        <form method="post" action="{{ route('room-cleaning-queue.enqueue') }}">
                                            @csrf
                                            <label for="room_number">Enter room number to clean:</label>
                                            <input type="number" name="room_number" id="room_number">
                                            <button type="submit">Enqueue</button>
                                        </form>

                                        <form method="post" action="{{ route('room-cleaning-queue.clean') }}">
                                            @csrf
                                            <button type="submit">Clean Next Room</button>
                                        </form>

                                        <h2>Queue:</h2>
                                        <ul>
                                            @foreach($queue->toArray() as $room)
                                                <li>Room : {{$room}}</li>
                                            @endforeach
                                        </ul>

                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
                <!-- // Basic form layout section end -->
            </div>
        </div>
    </div>

@stop

@section('script')

    <script>
        $('input:radio[name="type"]').change(
            function(){
                if (this.checked && this.value == '2') {  // 1 if main cat - 2 if sub cat
                    $('#cats_list').removeClass('hidden');

                }else{
                    $('#cats_list').addClass('hidden');
                }
            });
    </script>
@stop
