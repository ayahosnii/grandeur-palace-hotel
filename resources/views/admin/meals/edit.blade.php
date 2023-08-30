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
                                        <form class="form"
                                              action="{{route('admin.employees.update', $employee->id)}}"
                                              method="POST"
                                              enctype="multipart/form-data">
                                            @csrf



                                            <div class="form-body">

                                                <h4 class="form-section"><i class="ft-home"></i> بيانات الوظيفة </h4>
                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> اسم الموظف </label>
                                                            <input type="text" id="name"
                                                                   class="form-control"
                                                                   placeholder=" "
                                                                   value="{{ $employee->name }}"
                                                                   name="name">
                                                            @error("name")
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput1"> الوظيفة </label>
                                                            <select name="job_id" class="form-control">
                                                                <optgroup label="من فضلك اختر القسم">
                                                                    @if($jobs && $jobs->count() > 0)
                                                                        @foreach($jobs as $job)
                                                                            <option value="{{ $job->id }}" {{ $job->id == $employee->job_id ? 'selected' : '' }}>
                                                                                {{ $job->title }}
                                                                            </option>
                                                                        @endforeach
                                                                    @endif
                                                                </optgroup>
                                                            </select>
                                                            @error('job_id')
                                                            <span class="text-danger"> {{$message}}</span>
                                                            @enderror
                                                        </div>

                                                    </div>
                                                </div>

                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput3"> الراتب الأساسي </label>
                                                            <input type="text" id="basic_salary"
                                                                   class="form-control"
                                                                   placeholder=" "
                                                                   value="{{ $salaryDetail->basic_salary }}"
                                                                   name="basic_salary">
                                                            @error("basic_salary")
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>

                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <label for="projectinput2"> الرقم الوظيفي للموظف </label>
                                                            <input type="date" id="effective_date"
                                                                   class="form-control"
                                                                   placeholder=" "
                                                                   value="{{ $salaryDetail->effective_date }}"
                                                                   name="effective_date">
                                                            @error("effective_date")
                                                            <span class="text-danger">{{ $message }}</span>
                                                            @enderror
                                                        </div>
                                                    </div>
                                                </div>


                                                <div class="row">
                                                    <div class="col-md-6">
                                                        <div class="form-group mt-1">
                                                            <input type="checkbox" value="1"
                                                                   name="is_active"
                                                                   id="switcheryColor4"
                                                                   class="switchery" data-color="success"
                                                                   checked/>
                                                            <label for="switcheryColor4"
                                                                   class="card-title ml-1">الحالة </label>

                                                            @error("is_active")
                                                            <span class="text-danger">{{$message }}</span>
                                                            @enderror
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
