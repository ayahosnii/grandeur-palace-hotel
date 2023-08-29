<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\salary_calculate\CalculateDaysInCurrentMonth;
use App\Helpers\salary_calculate\CalculateRemainDaysInCurrentMonth;
use App\Http\Controllers\Controller;
use App\Models\admin\Attendance;
use App\Models\admin\Employee;
use App\Models\admin\Job;
use App\Models\admin\Punctuality;
use App\Models\admin\SalaryDetail;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $employees = Employee::get();
        return view('admin.employees.index', compact('employees'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $jobs = Job::get();
        return view('admin.employees.create', compact('jobs'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'job_id' => 'required|exists:jobs,id',
            'basic_salary' => 'required|numeric',
            'effective_date' => 'required|date',
            'is_active' => 'boolean',
        ]);

        $employee = Employee::create([
            'name' => $request->input('name'),
            'job_id' => $request->input('job_id'),
            'is_active' => $request->has('is_active'),
        ]);

        // Check if the day of effective_date is the first day of the month
        $effectiveDate = new \DateTime($request->input('effective_date'));
        $isFirstDayOfMonth = $effectiveDate->format('d') === '01';

        if ($isFirstDayOfMonth) {
            // If it's the first day of the month, set new_salary to basic_salary
            $newSalary = $request->input('basic_salary');
        } else {
            // If it's another day of the month, calculate new_salary
            $daysInCurrentMonth = new CalculateDaysInCurrentMonth();
            $workingDaysCount = $daysInCurrentMonth->getWorkingDaysCount();

            $remainDaysInCurrentMonth = new CalculateRemainDaysInCurrentMonth();
            $daysWorked = $remainDaysInCurrentMonth->getWorkingDaysCount($request->input('effective_date'));

            $dailySalary = $request->input('basic_salary') / $workingDaysCount;
            $partialMonthSalary = $dailySalary * $daysWorked;

            $newSalary = $partialMonthSalary;
        }

        SalaryDetail::create([
            'employee_id' => $employee->id,
            'basic_salary' => $request->input('basic_salary'),
            'effective_date' => $request->input('effective_date'),
            'new_salary' => $newSalary, // Set the calculated new_salary
        ]);

        return redirect()->route('admin.employees')->with(['success' => 'تم اضافة الموظف بنجاح']);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\admin\Employee  $employee
     * @return \Illuminate\Http\Response
     */

    public function show(Employee $employee)
    {
        //
    }



    public function profile($id)
    {
        $employee = Employee::find($id);
        $work_start_date = SalaryDetail::where('employee_id', $employee->id)->first();
        $work_start_date = Carbon::parse($work_start_date->effective_date)->format('Y-m-d');
        $currentYear = Carbon::now()->year;
        $currentMonth = Carbon::now()->month;

        $attendances = Attendance::where('employee_id', $employee->id)
            ->where('present', 0)
            ->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->get();

        // Get the salary details for the current month and year
        $salaryDetail = SalaryDetail::where('employee_id', $employee->id)
            ->whereYear('effective_date', $currentYear)
            ->whereMonth('effective_date', $currentMonth)
            ->first();

        // If the salary details for the current month and year don't exist, set default values
        if (!$salaryDetail) {
            $salaryDetail = null;
        }

        // Get the punctualities for the current month
        $punctualities = Punctuality::whereHas('attendance', function ($query) use ($currentYear, $currentMonth, $employee) {
            $query->where('employee_id', $employee->id)
                ->whereYear('created_at', $currentYear)
                ->whereMonth('created_at', $currentMonth);
        })->get();

        return view('admin.employees.profile', compact('employee', 'attendances', 'salaryDetail', 'punctualities', 'work_start_date'));
    }




    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\admin\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $employee = Employee::find($id);

        if (!$employee) {
            return redirect()->route('admin.employees')->with(['error' => 'هذا الموظف غير موجود']);
        }

        $salaryDetail = SalaryDetail::where('employee_id', $employee->id)->first();

        if (!$salaryDetail) {
            $salaryDetail = new SalaryDetail();
        }

        $jobs = Job::all();
        return view('admin.employees.edit', compact('employee', 'salaryDetail', 'jobs'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\admin\Employee  $employee
     * @return \Illuminate\Http\Response
     */

    public function update(Request $request, $id)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'job_id' => 'required|exists:jobs,id',
            'basic_salary' => 'required|numeric',
            'effective_date' => [
                'required',
                'date',
                function ($attribute, $value, $fail) use ($id) {
                    $firstAttendanceDate = Attendance::where('employee_id', $id)
                        ->oldest('created_at')->first();

                    if (Carbon::parse($value)->lte(Carbon::parse($firstAttendanceDate->created_at)) == false) {
                        $fail("The $attribute must be after the date of the first attendance for the employee.");
                    }
                },
            ],
            'is_active' => 'boolean',
        ]);

        $employee = Employee::findOrFail($id);

        // Check if the day of effective_date is the first day of the month
        $effectiveDate = new \DateTime($request->input('effective_date'));
        $isFirstDayOfMonth = $effectiveDate->format('d') === '01';

        if ($isFirstDayOfMonth) {
            // If it's the first day of the month, set new_salary to basic_salary
            $newSalary = $request->input('basic_salary');
        } else {
            // If it's another day of the month, calculate new_salary
            $daysInCurrentMonth = new CalculateDaysInCurrentMonth();
            $workingDaysCount = $daysInCurrentMonth->getWorkingDaysCount();

            $remainDaysInCurrentMonth = new CalculateRemainDaysInCurrentMonth();
            $daysWorked = $remainDaysInCurrentMonth->getWorkingDaysCount($request->input('effective_date'));

            $dailySalary = $request->input('basic_salary') / $workingDaysCount;
            $partialMonthSalary = $dailySalary * $daysWorked;

            $newSalary = $partialMonthSalary;
        }

        $employee->update([
            'name' => $request->input('name'),
            'job_id' => $request->input('job_id'),
            'is_active' => $request->has('is_active'),
        ]);

        $salaryDetail = SalaryDetail::where('employee_id', $employee->id)->first();

        if ($salaryDetail) {
            $salaryDetail->update([
                'basic_salary' => $request->input('basic_salary'),
                'effective_date' => $request->input('effective_date'),
                'new_salary' => $newSalary, // Set the calculated new_salary
            ]);
        } else {
            SalaryDetail::create([
                'employee_id' => $employee->id,
                'basic_salary' => $request->input('basic_salary'),
                'effective_date' => $request->input('effective_date'),
                'new_salary' => $newSalary, // Set the calculated new_salary
            ]);
        }

        return redirect()->route('admin.employees')->with(['success' => 'تم تحديث بيانات الموظف بنجاح']);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\admin\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy(Employee $employee)
    {
        //
    }
}
