<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\salary_calculate\SalaryCalculatorPerHour;
use App\Helpers\salary_calculate\SalaryCalculatorPerMinute;
use App\Http\Controllers\Controller;
use App\Models\admin\Attendance;
use App\Models\admin\Punctuality;
use App\Models\admin\SalaryDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class PunctualityController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        // Get the attendances with check-in after 07:10:00 and check-out before 13:50:00
        // that do not have punctuality records with status 'accept' or 'reject'
        $attendances = Attendance::where(function ($query) {
            $query->whereTime('check_in', '>', '07:10:00')
                ->orWhereTime('check_out', '<', '13:50:00');
        })
            ->whereDoesntHave('punctuality', function ($query) {
                $query->whereIn('status', ['accept', 'reject']);
            })
            ->get();


        $expectedCheckInTime = strtotime('07:10:00');
        $expectedCheckoutTime = strtotime('13:50:00');

        // Calculate the salary deduction for each attendance record
        $salaryCalculator = new SalaryCalculatorPerMinute();

        // Fetch the basic_salary for each employee based on the created_at month of the attendance
        foreach ($attendances as $attendance) {
            $employee = $attendance->employee;
            $createdMonth = Carbon::parse($attendance->created_at)->format('m');
            $createdYear = Carbon::parse($attendance->created_at)->format('Y');

            $salaryDetails = $employee->salaryDetails()
                ->whereMonth('effective_date', $createdMonth)
                ->whereYear('effective_date', $createdYear)
                ->first();

            if (!$salaryDetails) {
                // If SalaryDetail for the createdMonth doesn't exist, create a new one
                $previousSalaryDetail = $employee->salaryDetails()
                    ->orderBy('effective_date', 'desc')
                    ->first();

                $absences = 0; // You need to define how to calculate $absences

                $effectiveDate = Carbon::createFromDate($createdYear, $createdMonth, 1);

                if ($previousSalaryDetail) {
                    $newSalary = $previousSalaryDetail->basic_salary - $absences ?? 0;
                } else {
                    // If no previous SalaryDetail exists, use the basic_salary of the employee
                    $newSalary = $employee->salaryDetails()->orderBy('id', 'desc')->value('basic_salary');
                }

                // Create the new SalaryDetail
                $salaryDetails = SalaryDetail::create([
                    'employee_id' => $employee->id,
                    'basic_salary' => $previousSalaryDetail ? $previousSalaryDetail->basic_salary : $employee->basic_salary,
                    'absences' => $absences ?? 0,
                    'effective_date' => $effectiveDate,
                    'new_salary' => $newSalary,
                ]);
            }

            // Assuming the column name for basic_salary is 'basic_salary'
            $basicSalary = $salaryDetails->basic_salary;

            // Calculate the salary deduction for the current attendance
            $deductionValue = $salaryCalculator->calculateSalaryDeduction(
                $basicSalary,
                strtotime($attendance->check_in),
                strtotime($attendance->check_out),
                $expectedCheckInTime,
                $expectedCheckoutTime
            );

            // Add the calculated deduction value to the attendance object
            $attendance->deduction_value = $deductionValue;
        }

        return view('admin.attendance.punctuality', compact('attendances', 'salaryCalculator', 'expectedCheckInTime', 'expectedCheckoutTime'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'attendance_id' => 'required|exists:attendances,id',
            'reason' => 'nullable',
            'status' => 'required|in:pending,accept,reject',
        ]);

        if ($validator->fails()) {
            return redirect()->back()->withErrors($validator)->withInput();
        }

        $attendanceId = $request->input('attendance_id');
        $reason = $request->input('reason');
        $status = $request->input('status');
        if ($status == 'accept') {
            $deduction_value = 0;
        } else{
            $deduction_value = $request->input('deduction_value');
        }
        $punctuality = Punctuality::where('attendance_id', $attendanceId)->first();

        if ($punctuality) {
            $punctuality->update([
                'reason' => $reason,
                'status' => $status,
                'deduction_value' => $deduction_value
            ]);
        } else {
            $punctualityData = [
                'attendance_id' => $attendanceId,
                'reason' => $reason,
                'status' => $status,
                'deduction_value' => $deduction_value
            ];
            $p = Punctuality::create($punctualityData);
        }

        if ($status == 'reject') {
            // Get the month and year from the created_at field of the attendance
            $createdMonth = $punctuality->attendance->created_at->format('m') ?? $p->attendance->created_at->format('m');
            $createdYear = $punctuality->attendance->created_at->format('Y') ?? $p->attendance->created_at->format('y');;


            // Get the relevant SalaryDetail record for the employee and month
            $employeeId = $punctuality->attendance->employee_id;
            $salaryDetail = SalaryDetail::where('employee_id', $employeeId)
                ->whereYear('effective_date', $createdYear)
                ->whereMonth('effective_date', $createdMonth)
                ->first();

            if ($salaryDetail) {
                // Calculate the new_salary by deducting the deduction_value from the basic_salary
                $newSalary = $salaryDetail->basic_salary - $deduction_value;

                // Update the SalaryDetail record with the new_salary
                $salaryDetail->update([
                    'new_salary' => $newSalary,
                ]);
            }
        }

        return redirect()->back()->with('success', 'Punctuality status updated successfully.');
    }


    /**
     * Display the specified resource.
     *
     * @param  \App\Models\admin\Punctuality  $punctuality
     * @return \Illuminate\Http\Response
     */
    public function show(Punctuality $punctuality)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\admin\Punctuality  $punctuality
     * @return \Illuminate\Http\Response
     */
    public function edit(Punctuality $punctuality)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\admin\Punctuality  $punctuality
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Punctuality $punctuality)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\admin\Punctuality  $punctuality
     * @return \Illuminate\Http\Response
     */
    public function destroy(Punctuality $punctuality)
    {
        //
    }
}
