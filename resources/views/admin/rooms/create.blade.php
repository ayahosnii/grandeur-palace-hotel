@extends('layouts.back-layout')
@section('content')
    @push('styles')
        <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/vendors/css/forms/icheck/icheck.css')}}">

        <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/vendors/css/forms/icheck/custom.css')}}">

        <link rel="stylesheet" type="text/css" href="{{asset('assets/admin/css/plugins/forms/checkboxes-radios.css')}}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.css">

        <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/4.3.0/dropzone.js"></script>

        <style lang="scss">
            .avatar-upload {
                position: relative;
                max-width: 205px;
                margin: 50px auto;
                .avatar-edit {
                    position: absolute;
                    right: 12px;
                    z-index: 1;
                    top: 10px;
                    input {
                        display: none;
                        + label {
                            display: inline-block;
                            width: 34px;
                            height: 34px;
                            margin-bottom: 0;
                            border-radius: 100%;
                            background: #FFFFFF;
                            border: 1px solid transparent;
                            box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.12);
                            cursor: pointer;
                            font-weight: normal;
                            transition: all .2s ease-in-out;
                            &:hover {
                                background: #f1f1f1;
                                border-color: #d6d6d6;
                            }
                            &:after {
                                content: "\f040";
                                font-family: 'FontAwesome';
                                color: #757575;
                                position: absolute;
                                top: 10px;
                                left: 0;
                                right: 0;
                                text-align: center;
                                margin: auto;
                            }
                        }
                    }
                }
                .avatar-preview {
                    width: 192px;
                    height: 192px;
                    position: relative;
                    border-radius: 100%;
                    border: 6px solid #F8F8F8;
                    box-shadow: 0px 2px 4px 0px rgba(0, 0, 0, 0.1);
                    > div {
                        width: 100%;
                        height: 100%;
                        border-radius: 100%;
                        background-size: cover;
                        background-repeat: no-repeat;
                        background-position: center;
                    }
                }
            }
        </style>
    @endpush

<div class="app-content content">
    <div class="content-wrapper">
        <div class="content-header row">
            <div class="content-header-left col-md-6 col-12 mb-2">
                <div class="row breadcrumbs-top">
                    <div class="breadcrumb-wrapper col-12">
                        <ol class="breadcrumb">
                            <li class="breadcrumb-item"><a href="">Home </a>
                            </li>
                            <li class="breadcrumb-item"><a href="{{route('admin.rooms')}}"> Rooms  </a>
                            </li>
                            <li class="breadcrumb-item active">  Add a room
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
                                <h4 class="card-title" id="basic-layout-form"> Add a room </h4>
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
                                <div class="card-body">
                                    <form class="form"
                                          action="{{route('admin.rooms.store')}}"
                                          method="POST"
                                          enctype="multipart/form-data">
                                        @csrf


                                        <div class="form-body">

                                            <h4 class="form-section">
                                                <i class="ft-home"></i> Add more information about the room
                                            </h4>
                                            <div class="form-group">
                                                <label> صورة المنتج </label>
                                                <label id="projectinput7" class="file center-block">
                                                    <div class="avatar-upload">
                                                        <div class="avatar-edit">
                                                            <input type='file' id="imageUpload" name="image" accept=".png, .jpg, .jpeg" />
                                                            <label for="imageUpload"></label>
                                                        </div>
                                                        <div class="avatar-preview">
                                                            <div id="imagePreview" style="background-image: url(http://127.0.0.1:8000/assets/admin/images/logo.png);">
                                                            </div>
                                                        </div>
                                                    </div>
                                                </label>
                                                @error('image')
                                                <span class="text-danger">{{$message}}</span>
                                                @enderror
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> Room Type
                                                        </label>
                                                        <input type="text" id="room_type"
                                                               class="form-control"
                                                               placeholder="  "
                                                               value="{{old('room_type')}}"
                                                               name="room_type">
                                                     @error("room_type")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> Price
                                                        </label>
                                                        <input type="text" id="price_per_night"
                                                               class="form-control"
                                                               placeholder="  "
                                                               value="{{old('price_per_night')}}"
                                                               name="price_per_night">
                                                     @error("price_per_night")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> Size
                                                        </label>
                                                        <input type="text" id="size"
                                                               class="form-control"
                                                               placeholder="  "
                                                               value="{{old('size')}}"
                                                               name="size">
                                                     @error("size")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> Capacity
                                                        </label>
                                                        <input type="text" id="capacity"
                                                               class="form-control"
                                                               placeholder="  "
                                                               value="{{old('capacity')}}"
                                                               name="capacity">
                                                     {{--@error("capacity")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror--}}
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> Bed type
                                                        </label>
                                                        <input type="text" id="bed_type"
                                                               class="form-control"
                                                               placeholder="  "
                                                               value="{{old('bed_type')}}"
                                                               name="bed_type">
                                                     @error("bed_type")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="projectinput1"> Adults
                                                        </label>
                                                        <input type="text" id="adults"
                                                               class="form-control"
                                                               placeholder="  "
                                                               value="{{old('adults')}}"
                                                               name="adults">
                                                     @error("adults")
                                                        <span class="text-danger">{{$message}}</span>
                                                        @enderror
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <div class="form-group">
                                                        <h3 class="py-2">Choose Services</h3>
                                                        <div class="row skin skin-square">
                                                            @foreach($services as $id => $name)
                                                                <div class="col-md-6 col-sm-12">
                                                                    <fieldset>
                                                                        <input type="checkbox" name="services[]" id="service-{{ $id }}" value="{{ $id }}">
                                                                        <label for="service-{{ $id }}">{{ $name }}</label>
                                                                    </fieldset>
                                                                </div>
                                                            @endforeach                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>



                                        <div class="form-actions">
                                            <button type="button" class="btn btn-warning mr-1"
                                                    onclick="history.back();">
                                                <i class="ft-x"></i> تراجع
                                            </button>
                                            <button type="submit" class="btn btn-primary">
                                                <i class="la la-check-square-o"></i> تحديث
                                            </button>
                                        </div>
                                    </form>

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
@push('scripts')
    <script>
        function readURL(input) {
            if (input.files && input.files[0]) {
                var reader = new FileReader();
                reader.onload = function(e) {
                    $('#imagePreview').css('background-image', 'url('+e.target.result +')');
                    $('#imagePreview').hide();
                    $('#imagePreview').fadeIn(650);
                }
                reader.readAsDataURL(input.files[0]);
            }
        }
        $("#imageUpload").change(function() {
            readURL(this);
        });
    </script>
    <script src="{{asset('assets/admin/vendors/js/forms/icheck/icheck.min.js')}}" type="text/javascript"></script>

    <script src="{{asset('assets/admin/js/scripts/forms/checkbox-radio.js')}}" type="text/javascript"></script>
    <script src="{{asset('assets/admin/js/scripts/extensions/dropzone.js')}}" type="text/javascript"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"></script>

@endpush
