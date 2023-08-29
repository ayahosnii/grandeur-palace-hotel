
@extends('layouts.back-layout')
@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="">الرئيسية </a>
                                </li>
                                <li class="breadcrumb-item"><a href="{{--route('admin.attributes')--}}"> خصائص المنتج  </a>
                                </li>
                                <li class="breadcrumb-item active">  أضافه ماركة تجارية
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
                                    <h4 class="card-title" id="basic-layout-form"> أضافه ماركة تجارية </h4>
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
                                <div class="content-detached">
                                    <div class="content-body">
                                        <section class="row">
                                            <div class="col-12">
                                                <div class="card">
                                                <div class="card-head">
                                                    <div class="card-header">
                                                        <h4 class="card-title">All Contacts</h4>
                                                        <a class="heading-elements-toggle"><i class="la la-ellipsis-h font-medium-3"></i></a>
                                                        <div class="heading-elements">
                                                            <button class="btn btn-primary btn-sm"><i class="ft-plus white"></i> Add Contacts</button>
                                                            <span class="dropdown">
        <button id="btnSearchDrop1" type="button" data-toggle="dropdown" aria-haspopup="true"
                aria-expanded="true" class="btn btn-warning dropdown-toggle dropdown-menu-right btn-sm"><i class="ft-download-cloud white"></i></button>
        <span aria-labelledby="btnSearchDrop1" class="dropdown-menu mt-1 dropdown-menu-right">
          <a href="#" class="dropdown-item"><i class="ft-upload"></i> Import</a>
          <a href="#" class="dropdown-item"><i class="ft-download"></i> Export</a>
          <a href="#" class="dropdown-item"><i class="ft-shuffle"></i> Find Duplicate</a>
        </span>
      </span>
                                                            <button class="btn btn-default btn-sm"><i class="ft-settings white"></i></button>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="card-content">
                                                <div class="card-body">
                                                <form class="form"
                                                      action="{{route('admin.attendance.store')}}"
                                                      method="POST"
                                                      enctype="multipart/form-data">
                                                    @csrf
                                                <!-- Task List table -->
                                                <div class="table-responsive">
                                                    <table id="users-contacts" class="table table-white-space table-bordered row-grouping display no-wrap icheck table-middle">
                                                        <thead>
                                                        <tr>
                                                            <th>اسم الموظف</th>
                                                            <th>الوظيفة</th>
                                                            <th>الحضور</th>
                                                            <th>وقت الحضور</th>
                                                            <th>وقت الانصراف</th>
                                                        </tr>
                                                        </thead>
                                                        <tbody>
                                                        @isset($employees)
                                                            @foreach($employees as $employee)
                                                                <tr>
                                                                    <td>
                                                                        <div class="media">
                                                                            <div class="media-left pr-1">
                                                                            <span class="avatar avatar-sm avatar-online rounded-circle">
                                                                            <img src="{{asset('assets/admin/images/icons/user.png')}}" alt="avatar"><i></i>
                                                                            </span>
                                                                            </div>
                                                                            <div class="media-body media-middle">
                                                                                <a href="#" class="media-heading">{{$employee->name}}</a>
                                                                                <input type="hidden" name="employee_id[]" value="{{ $employee->id }}">
                                                                            </div>
                                                                        </div>
                                                                    </td>
                                                                    <td>
                                                                        <p>{{$employee->job->title}}</p>
                                                                    </td>
                                                                    @if(isset($attendances[$employee->id]))
                                                                        <td>
                                                                            <input type="checkbox" class="input-chk" name="present[]" value="1" @if($attendances[$employee->id]->present) checked @endif>
                                                                        </td>
                                                                        <td>
                                                                            <div class="input-group">
                                                                                <div class="input-group-prepend">
                                                                                <span class="input-group-text">
                                                                                    <span class="ft-clock"></span>
                                                                                </span>
                                                                                </div>
                                                                                <input type='text' class="form-control pickatime-minmax" placeholder="Start Time" name="check_in[]" value="{{ old('check_in.'.$loop->index, $attendances[$employee->id]->check_in ?? null) }}">
                                                                            </div>
                                                                            @error('check_in.'.$loop->index)
                                                                            <span class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </td>
                                                                        <td>
                                                                            <div class="input-group">
                                                                                <div class="input-group-prepend">
                                                                                <span class="input-group-text">
                                                                                    <span class="ft-clock"></span>
                                                                                </span>
                                                                                </div>
                                                                                <input type='text' class="form-control pickatime-minmax" placeholder="End Time" name="check_out[]" value="{{ old('check_out.'.$loop->index, $attendances[$employee->id]->check_out ?? null) }}">
                                                                            </div>
                                                                            @error('check_out.'.$loop->index)
                                                                            <span class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </td>
                                                                    @else
                                                                        <!-- If there's no attendance record for the employee, display empty fields -->
                                                                        <td>
                                                                            <input type="checkbox" class="input-chk" name="present[]" value="1">
                                                                        </td>
                                                                        <td>
                                                                            <div class="input-group">
                                                                                <div class="input-group-prepend">
                                                                                <span class="input-group-text">
                                                                                    <span class="ft-clock"></span>
                                                                                </span>
                                                                                </div>
                                                                                <input type='text' class="form-control pickatime-minmax" placeholder="Start Time" name="check_in[]" value="{{ old('check_in.'.$loop->index, '07:00:00') }}">
                                                                            </div>
                                                                            @error('check_in.'.$loop->index)
                                                                            <span class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </td>
                                                                        <td>
                                                                            <div class="input-group">
                                                                                <div class="input-group-prepend">
                                                                                    <span class="input-group-text">
                                                                                        <span class="ft-clock"></span>
                                                                                    </span>
                                                                                </div>
                                                                                <input type='text' class="form-control pickatime-minmax" placeholder="End Time" name="check_out[]" value="{{ old('check_out.'.$loop->index, '14:00:00') }}">
                                                                            </div>
                                                                            @error('check_out.'.$loop->index)
                                                                            <span class="text-danger">{{ $message }}</span>
                                                                            @enderror
                                                                        </td>
                                                                    @endif
                                                                </tr>
                                                            @endforeach

                                                        @endisset

                                                        </tbody>
                                                        <tfoot>
                                                        <tr>
                                                            <th>اسم الموظف</th>
                                                            <th>الوظيفة</th>
                                                            <th>الحضور</th>
                                                            <th>وقت الحضور</th>
                                                            <th>وقت الانصراف</th>
                                                        </tr>
                                                        </tfoot>
                                                    </table>
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
