
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
                                    <h4 class="card-title" id="basic-layout-form"> {{\Carbon\Carbon::now()->setTimezone('Asia/Beirut')}} </h4>
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
                                                    <!-- Task List table -->
                                                    <div class="table-responsive">
                                                        @isset($attendances)
                                                            @foreach($attendances as $attendance)
                                                                <form class="form"
                                                                      action="{{ route('admin.punctuality.store') }}"
                                                                      method="POST"
                                                                      enctype="multipart/form-data">
                                                                    @csrf
                                                                    <input type="hidden" name="attendance_id" value="{{ $attendance->id }}">
                                                                    <table id="users-contacts"
                                                                           class="table table-white-space table-bordered row-grouping display no-wrap icheck table-middle">
                                                                        <thead>
                                                                        <tr>
                                                                            <th>
                                                                                <div class="media">
                                                                                    <div class="media-left pr-1">
                                        <span class="avatar avatar-sm avatar-online rounded-circle">
                                            <img src="{{ asset('assets/admin/images/icons/user.png') }}" alt="avatar">
                                            <i></i>
                                        </span>
                                                                                    </div>
                                                                                    <div class="media-body media-middle">
                                                                                        <a href="#" class="media-heading">{{ $attendance->employee->name }}</a>
                                                                                    </div>
                                                                                </div>
                                                                            </th>
                                                                        </tr>
                                                                        </thead>
                                                                        <tbody>

                                                                        <tr>
                                                                            <td>
                                                                                التاريخ
                                                                            </td>
                                                                            <td>
                                                                                <p>{{ $attendance->created_at->format('Y-m-d') }}</p>
                                                                            </td>
                                                                        </tr>

                                                                        <tr>
                                                                            <td>
                                                                                الحالة
                                                                            </td>
                                                                            <td>
                                                                                @if ($attendance->check_in > '07:15:00' && $attendance->check_out < '13:50:00')
                                                                                    متأخر جاء الساعة {{ $attendance->check_in }}
                                                                                    وغادر مبكرا في الساعة {{ $attendance->check_out }}
                                                                                @elseif ($attendance->check_in > '07:15:00')
                                                                                    متأخر جاء في الساعة {{ $attendance->check_in }}
                                                                                @elseif ($attendance->check_out < '13:50:00')
                                                                                    غادر مبكرا {{ $attendance->check_out }}
                                                                                @else
                                                                                    غادر مبكرا في الوقت المسموح{{ $attendance->check_out }}
                                                                                @endif
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                السبب
                                                                            </td>
                                                                            <td>
                                                                                <textarea class="form-control" name="reason">{{ old('reason.'.$loop->index) }}</textarea>
                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                قيمة الخصم وفقا لقيمة للراتب بالدقيقة
                                                                            </td>
                                                                            <td>
                                                                                <input class="form-control" name="deduction_value"
                                                                                       value="{{ $salaryCalculator->calculateSalaryDeduction(
                                                                                                        $attendance->employee->salaryDetails->basic_salary,
                                                                                                        strtotime($attendance->check_in),
                                                                                                        strtotime($attendance->check_out),
                                                                                                        $expectedCheckInTime, $expectedCheckoutTime) }}">

                                                                                <input type="hidden" name="attendance_id" value="{{ $attendance->id }}">
                                                                                <input type="hidden" name="effective_date" value="{{ $attendance->employee->salaryDetails->effective_date->format('Y-m-d') }}">

                                                                            </td>
                                                                        </tr>
                                                                        <tr>
                                                                            <td>
                                                                                القبول
                                                                            </td>
                                                                            <td>
                                                                                <select name="status">
                                                                                    <option value="pending">تعليق</option>
                                                                                    <option value="accept">قبول</option>
                                                                                    <option value="reject">رفض</option>
                                                                                </select>
                                                                            </td>
                                                                        </tr>
                                                                        </tbody>
                                                                    </table>
                                                                    <div class="form-actions">
                                                                        <button type="submit" class="btn btn-primary">
                                                                            <i class="la la-check-square-o"></i> تحديث
                                                                        </button>
                                                                    </div>
                                                                </form>
                                                            @endforeach
                                                        @endisset
                                                    </div>

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
