<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\admin\Attendance;
use App\Models\admin\Employee;
use App\Models\admin\SalaryDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::all();
        $today = Carbon::today();
        $daysInMonth = $today->daysInMonth;

        $daysOfMonth = [];
        for ($day = 1; $day <= $daysInMonth; $day++) {
            $daysOfMonth[] = $today->setDay($day)->format('Y-m-d');
        }

        $attendanceData = Attendance::whereMonth('created_at', $today->month)->get();

        return view('admin.attendance.index', [
            'daysOfMonth' => $daysOfMonth,
            'employees' => $employees,
            'attendanceData' => $attendanceData,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\Contracts\View\View
     */
    public function create()
    {
        $employees = Employee::get();
        $attendances = Attendance::whereDate('created_at', Carbon::today())
            ->get()
            ->keyBy('employee_id');

        return view('admin.attendance.create', compact('employees', 'attendances'));
    }

    public function absence()
    {
        $employees = Employee::get();
        $attendances = Attendance::where('present', 0)
            ->where(function ($q) {
                $q->where('status', NULL)
                    ->orWhere('status', 'pending');
            })
            ->orderBy('created_at', 'asc')
            ->get()
            ->keyBy('employee_id');


        return view('admin.attendance.absence', compact('employees', 'attendances'));
    }

    public function absenceStore(Request $request)
    {
        $attendance = Attendance::find($request->input('attendance_id'));


        if (!$attendance) {
            return redirect()->back()->with('error', 'Attendance record not found.');
        }

        if ($request->input('status') == 'accept') {
            $request->merge(['deduction_percentage' => 0]);
        }

        $attendance->update([
            'status' => $request->input('status'),
            'deduction_type' => $request->input('deduction_type'),
            'deduction_percentage' => $request->input('deduction_percentage'),
            'deduction_reason' => $request->input('deduction_reason'),
        ]);



        $monthOfAttendance = $attendance->created_at->format('m');
        $yearOfAttendance = $attendance->created_at->format('Y');

        $salaryDetail = SalaryDetail::where('employee_id', $attendance->employee_id)
            ->whereMonth('effective_date', $monthOfAttendance)
            ->whereYear('effective_date', $yearOfAttendance)
            ->first();


        $absences = $attendance->deduction_type === 'present'
            ? ($attendance->deduction_percentage / 100) * $salaryDetail->basic_salary
            : $attendance->deduction_percentage;

        if ($salaryDetail) {
            // Update the existing SalaryDetail record
            $salaryDetail->update([
                'absences' => $salaryDetail->absences + $absences,
                'new_salary' => $salaryDetail->new_salary - $absences,
            ]);
        } else {
            $previousMonthDate = Carbon::now()->subMonth();
            $monthOfAttendance = $previousMonthDate->format('m');
            $yearOfAttendance = $previousMonthDate->format('Y');

            $previousSalaryDetail = SalaryDetail::where('employee_id', $attendance->employee_id)
                ->whereMonth('effective_date', $monthOfAttendance)
                ->whereYear('effective_date', $yearOfAttendance)
                ->first();

            // Create a new SalaryDetail record for the current month and year
            $salaryDetail = SalaryDetail::create([
                'employee_id' => $attendance->employee_id,
                'basic_salary' => $previousSalaryDetail->basic_salary,
                'absences' => $absences ?? 0,
                'effective_date' => Carbon::now(),
                'new_salary' => $previousSalaryDetail->basic_salary - $absences ?? 0,
            ]);
        }

        return redirect()->back()->with('success', 'Attendance updated successfully.');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'employee_id' => 'required|array',
            'employee_id.*' => 'required|exists:employees,id',
            'present' => 'array',
            'present.*' => 'boolean',
            'check_in' => 'array',
            'check_in.*' => 'nullable|date_format:H:i:s|before:check_out.*|after_or_equal:07:00:00',
            'check_out' => 'array',
            'check_out.*' => 'nullable|date_format:H:i:s|after:check_in.*|before_or_equal:14:00:00',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        foreach ($request->employee_id as $index => $employeeId) {
            $present = isset($request->present[$index]) ? $request->present[$index] : false;
            $checkIn = $request->check_in[$index];
            $checkOut = $request->check_out[$index];
            if ($present == 0){
                $checkIn = NULL;
                $checkOut = NULL;
            }
            $attendanceData = [
                'employee_id' => $employeeId,
                'present' => $present,
                'check_in' => $checkIn,
                'check_out' => $checkOut,
            ];


            $attendance = Attendance::where('employee_id', $employeeId)
                ->whereDate('created_at', Carbon::today())
                ->first();

            if ($attendance && $attendance->punctuality) {
                return redirect()->back()->with('error', 'Punctuality entry already exists for this attendance.');
            }else if ($attendance) {
                $attendance->update($attendanceData);
            } else {
                Attendance::create($attendanceData);
            }
        }

        return redirect()->back()->with('success', 'Attendance records updated successfully.');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\admin\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function show(Attendance $attendance)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\admin\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function edit(Attendance $attendance)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\admin\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Attendance $attendance)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\admin\Attendance  $attendance
     * @return \Illuminate\Http\Response
     */
    public function destroy(Attendance $attendance)
    {
        //
    }
}
