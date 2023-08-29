@extends('layouts.back-layout')
@section('content')

    <div class="app-content content">
        <div class="content-wrapper">
            <!-- ... Existing content ... -->

            <div class="content-body">
                <!-- DOM - jQuery events table -->
                <section id="dom">
                    <div class="row">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header">
                                    <h4 class="card-title">غياب شهر {{\Carbon\Carbon::today()->month}}</h4>
                                    <a class="heading-elements-toggle"><i
                                            class="la la-ellipsis-v font-medium-3"></i></a>
                                    <div class="heading-elements">
                                        <!-- ... Existing heading elements ... -->
                                    </div>
                                </div>

                                <!-- ... Existing card content ... -->

                                <div class="card-content collapse show">
                                    <div class="card-body card-dashboard">
                                        <div class="table-responsive">
                                        <table class="table display nowrap table-striped table-bordered scroll-horizontal">
                                            <tbody>

                                            <tr style="width: 10px; height: 10px">
                                                <td style="width: 10px; height: 10px">الاسم</td>

                                                @foreach($daysOfMonth as $day)
                                                    <th style="width: 10px; height: 10px">{{ \Carbon\Carbon::parse($day)->format('d') }}</th>
                                                @endforeach

                                            </tr>
                                            @isset($employees)
                                                @foreach($employees as $employee)
                                                    <tr style="width: 10px; height: 10px">
                                                        <td style="width: 10px; height: 10px">
                                                            {{$employee->name}}
                                                        </td>
                                                        @foreach($daysOfMonth as $day)
                                                            @php
                                                                $foundMatch = false;
                                                            @endphp

                                                            @foreach($attendanceData as $attendance)
                                                                @if ($attendance->employee_id == $employee->id && \Carbon\Carbon::parse($attendance->created_at)->format('d') == \Carbon\Carbon::parse($day)->format('d') && $attendance->present == 1)
                                                                    @php
                                                                        $foundMatch = true;
                                                                    @endphp
                                                                    <td style="width: 10px; height: 10px"><li class="la la-check btn-success"></li></td>
                                                                    @break
                                                                @endif
                                                            @endforeach

                                                            @if(!$foundMatch)
                                                                <td>-</td>
                                                            @endif
                                                        @endforeach
                                                    </tr>
                                                @endforeach
                                            @endisset

                                            </tbody>
                                        </table>
                                        </div>
                                            <div class="justify-content-center d-flex">
                                            <!-- ... Existing pagination or other content ... -->
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
