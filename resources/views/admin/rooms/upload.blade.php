@extends('layouts.back-layout')
@section('content')
    @push('styles')
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/vendors/css/forms/icheck/icheck.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/vendors/css/forms/icheck/custom.css') }}">
        <link rel="stylesheet" type="text/css" href="{{ asset('assets/admin/css/plugins/forms/checkboxes-radios.css') }}">
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.css">
        <style>
            .wrapper {
                background: #39E2B6;
                height: 100%;
                width: 100%;
                position: fixed;
                top: 0;
                z-index: 9999;
                text-align: center;
                left: 0;
                font-size: 100px;
                font-family: calibri;
                color: white;
                line-height: 100vh;
            }

            .dropzone {
                width: 100%;
                margin: 1%;
                border: 2px dashed #3498db !important;
                border-radius: 5px;
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
                                <li class="breadcrumb-item"><a href="">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{ route('admin.rooms') }}">Rooms</a></li>
                                <li class="breadcrumb-item active">Add a room</li>
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
                                    <h4 class="card-title" id="basic-layout-form">Add a room</h4>
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
                                    <h2>{{ $room->id }}</h2>
                                    <div class="wrapper" style="visibility:hidden; opacity:0">DROP HERE</div>

                                    <form action="{{ route('rooms.img.upload.post', ['id' => $room->id]) }}"
                                          method="POST" id="upload-form" class="dropzone">
                                        @csrf
                                        <div class="previews"></div>
                                        <div class="dz-message">
                                            <span class="text">Drop files here or click to upload +</span>
                                        </div>
                                        <button class="btn btn-primary" type="submit">Submit data and files!</button>                                    </form>
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
    <script src="{{ asset('assets/admin/vendors/js/forms/icheck/icheck.min.js') }}" type="text/javascript"></script>
    <script src="{{ asset('assets/admin/js/scripts/forms/checkbox-radio.js') }}" type="text/javascript"></script>
    <script src="{{asset('assets/admin/js/scripts/extensions/dropzone.js')}}" type="text/javascript"></script>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/dropzone/5.9.2/min/dropzone.min.js"></script>
    <script>
        Dropzone.options.uploadForm = { // The camelized version of the ID of the form element

            // The configuration we've talked about above
            autoProcessQueue: false,
            uploadMultiple: true,
            parallelUploads: 100,
            maxFiles: 100,

            // The setting up of the dropzone
            init: function() {
                var myDropzone = this;

                // First change the button to actually tell Dropzone to process the queue.
                this.element.querySelector("button[type=submit]").addEventListener("click", function(e) {
                    // Make sure that the form isn't actually being sent.
                    e.preventDefault();
                    e.stopPropagation();
                    myDropzone.processQueue();
                });

                // Listen to the sendingmultiple event. In this case, it's the sendingmultiple event instead
                // of the sending event because uploadMultiple is set to true.
                this.on("sendingmultiple", function() {
                    // Gets triggered when the form is actually being sent.
                    // Hide the success button or the complete form.
                });
                this.on("successmultiple", function(files, response) {
                    // Gets triggered when the files have successfully been sent.
                    // Redirect user or notify of success.
                });
                this.on("errormultiple", function(files, response) {
                    // Gets triggered when there was an error sending the files.
                    // Maybe show form again, and notify user of error
                });
            }

        }
    </script>
@endpush
