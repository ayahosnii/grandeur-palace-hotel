@extends('layouts.back-layout')
@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <div class="content-header row">
                <div class="content-header-left col-md-6 col-12 mb-2">
                    <h3 class="content-header-title">تقرير عن الموظف</h3>
                    <div class="row breadcrumbs-top">
                        <div class="breadcrumb-wrapper col-12">
                            <ol class="breadcrumb">
                                <li class="breadcrumb-item"><a href="index.html">Home</a></li>
                                <li class="breadcrumb-item"><a href="{{route('admin.employees')}}">الموظفين</a></li>
                                <li class="breadcrumb-item active">تقرير عن الموظف</li>
                            </ol>
                        </div>
                    </div>
                </div>
                <div class="content-header-right col-md-6 col-12">
                    <div class="btn-group float-md-right" role="group" aria-label="Button group with nested dropdown">
                        <button class="btn btn-info round dropdown-toggle dropdown-menu-right box-shadow-2 px-2"
                                id="btnGroupDrop1" type="button" data-toggle="dropdown" aria-haspopup="true"
                                aria-expanded="false"><i class="ft-settings icon-left"></i> الاعدادات</button>
                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1">
                            <a class="dropdown-item" href="{{route('admin.employees.edit', $employee->id)}}">تعديل البيانات</a>
                            <a class="dropdown-item" href="component-buttons-extended.html">حذف الموظف</a>
                        </div>
                    </div>
                </div>
            </div>
            @include('admin.sections.alerts.success')
            @include('admin.sections.alerts.errors')
            <div class="content-body">
                <section class="card">
                    <div id="invoice-template" class="card-body">
                        <!-- Invoice Company Details -->
                        <div id="invoice-company-details" class="row">
                            <div class="col-md-6 col-sm-12 text-center text-md-left">
                                <div class="media">
                                    <img src="{{asset('assets/admin/images/icons/user.png')}}" alt="company logo" class="" style="width: 50px; height: 50px"/>
                                    <div class="media-body">
                                        <ul class="ml-2 px-0 list-unstyled">
                                            <li class="text-bold-800">الأسم: {{$employee->name}} </li>
                                            <li>الوظيفة: {{$employee->job->title}}</li>
                                        </ul>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-sm-12 text-center text-md-right">
                                <h2>تقرير موظف لشهر {{\Carbon\Carbon::now()->format('m')}}</h2>
                                <h5> تاريخ بدء العمل {{$work_start_date}}</h5>
                            </div>
                        </div>
                        <!--/ Invoice Company Details -->

                        <!-- Invoice Items Details -->
                        @if ($salaryDetail)
                                <div id="invoice-items-details" class="pt-2">
                                    <div class="row">
                                        <div class="table-responsive col-sm-12">
                                            <table class="table">
                                                <thead>
                                                <tr>
                                                    <th>عدد مرات الغياب</th>
                                                    <th class="text-right">المرتب الاساسي</th>
                                                    <th class="text-right">غياب</th>
                                                    <th class="text-right">قروض</th>
                                                    <th class="text-right">تأمين صحي</th>
                                                    <th class="text-right">مكافئات</th>
                                                    <th class="text-right">عمولات</th>
                                                    <th class="text-right">مرتب الشهر</th>
                                                    <th class="text-right">تاريخ التقرير</th>
                                                </tr>
                                                </thead>
                                                <tbody>
                                                <tr>
                                                    <td>
                                                        @if ($attendances->count() > 0)
                                                        <p>{{$attendances->count()}}</p>
                                                        @if($attendances->count() > 0) <p class="text-muted">السبب</p> @endif
                                                        @else
                                                            <div id="invoice-items-details" class="pt-2">
                                                                <h3>---</h3>
                                                            </div>
                                                        @endif
                                                    </td>
                                                    <td class="text-right">{{$salaryDetail->basic_salary}} LE</td>
                                                    <td class="text-right">{{$salaryDetail->absences}} LE</td>
                                                    <td class="text-right">{{$salaryDetail->loans}} LE</td>
                                                    <td class="text-right">{{$salaryDetail->health_insurance}} LE</td>
                                                    <td class="text-right">{{$salaryDetail->incentives}} LE</td>
                                                    <td class="text-right">{{$salaryDetail->commissions}} LE</td>
                                                    <td class="text-right">{{$salaryDetail->new_salary ?? $salaryDetail->basic_salary}} LE</td>
                                                    <td class="text-right">{{$salaryDetail->effective_date->format('M Y')}}</td>
                                                </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>


                            @if($employee->punctualities->count() > 0)
                                <div id="invoice-items-details" class="pt-2">
                                    <div class="row">
                                        <div class="table-responsive col-sm-12">
                                            <h3>الالتزام بالمواعيد (عدد مرات عدم الالتزام بالمواعيد في شهر - هي {{$punctualities->count()}} مرات)</h3>
                                            <table class="table">
                                                <thead>
                                                <th></th>
                                                <th>التاريخ</th>
                                                <th>الاسباب</th>
                                                <th>القبول</th>
                                                <th>قيمة الخصم</th>
                                                </thead>
                                                <tbody>
                                                @foreach($punctualities as $punctuality)
                                                    <tr>
                                                        <td>
                                                            {{ $punctuality->attendance->created_at ? $punctuality->attendance->created_at->format('Y-m-d') : 'لا يوجد تاريخ' }}
                                                        </td>
                                                        <td>
                                                            السبب {{ $loop->iteration }}
                                                        </td>
                                                        <td>
                                                            {{ $punctuality->reason == NULL ? 'لا يوجد سبب' : $punctuality->reason }}
                                                        </td>
                                                        <td>
                                                            {{$punctuality->status == 'accept' ? 'سبب مقبول' : ($punctuality->status == 'reject' ? 'غير مقبول' : 'معلق')}}
                                                        </td>
                                                        <td>
                                                            @if($punctuality->status == 'pending' || $punctuality->status == NULL)
                                                                لم يتم التحديد بعد
                                                            @else
                                                                {{$punctuality->deduction_value}}
                                                            @endif
                                                        </td>
                                                    </tr>
                                                @endforeach
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            @endif
                        @else
                            <div id="invoice-items-details" class="pt-2">
                                <h3>No data available for the current month.</h3>
                            </div>
                        @endif

                        @if($attendances->count() > 0)
                            <div id="invoice-items-details" class="pt-2">
                                <div class="row">
                                    <div class="table-responsive col-sm-12">
                                        <h3>الالتزام بالمواعيد (عدد مرات الغياب في شهر - هي {{$attendances->count()}} مرات)</h3>
                                        <table class="table">
                                            <thead>
                                            <th></th>
                                            <th>التاريخ</th>
                                            <th>الاسباب</th>
                                            <th>القبول</th>
                                            <th>قيمة الخصم</th>
                                            </thead>
                                            <tbody>
                                            @foreach($attendances as $attendance)
                                                <tr>
                                                    <td>
                                                        {{ $attendance->created_at ? $attendance->created_at->format('Y-m-d') : 'لا يوجد تاريخ' }}
                                                    </td>
                                                    <td>
                                                        السبب {{ $loop->iteration }}
                                                    </td>
                                                    <td>
                                                        {{ $attendance->deduction_reason == NULL ? 'لا يوجد سبب' : $attendance->deduction_reason }}
                                                    </td>
                                                    <td>
                                                        {{$attendance->status == 'accept' ? 'سبب مقبول' : ($attendance->status == 'reject' ? 'غير مقبول' : 'معلق')}}
                                                    </td>
                                                    <td>
                                                        @if($attendance->status == 'pending' || $attendance->status == NULL)
                                                            لم يتم التحديد بعد
                                                        @else
                                                            {{$attendance->deduction_percentage}} {{$attendance->deduction_type == "present" ? '%' : 'جنيه مصري'}}
                                                        @endif
                                                    </td>
                                                </tr>
                                            @endforeach
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        @endif
                    </div>
                </section>
            </div>
        </div>
    </div>
@endsection
