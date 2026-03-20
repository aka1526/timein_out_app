<?php

namespace App\Http\Controllers;

use App\Models\Employee;
use App\Models\TimeAttendance;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Rap2hpoutre\FastExcel\FastExcel;

class TimeAttendanceController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $attendances = TimeAttendance::with('employee')
            ->orderBy('date', 'desc')
            ->orderBy('time_in', 'desc')
            ->get();

        return view('time_attendances.index', compact('attendances'));
    }

    /**
     * Show the form for morning check-in.
     */
    public function morningCheckIn()
    {
        $employees = Employee::where('status', 'active')->get();
        return view('time_attendances.morning_check_in', compact('employees'));
    }

    /**
     * Store a newly created morning check-in record.
     */
    public function storeMorningCheckIn(Request $request)
    {
        // If no employee_id is provided (direct access from home), use the first active employee
        if (!$request->has('employee_id') || empty($request->employee_id)) {
            $employee = Employee::where('status', 'active')->first();

            if (!$employee) {
                return redirect('/')
                    ->with('error', 'No active employee found. Please create an employee first.');
            }

            $employeeId = $employee->id;
        } else {
            $request->validate([
                'employee_id' => 'required|exists:employees,id',
            ]);

            $employeeId = $request->employee_id;
        }

        $today = Carbon::today()->toDateString();
        $currentTime = Carbon::now()->toTimeString();

        // Check if employee already has morning check-in today
        $existingAttendance = TimeAttendance::where('employee_id', $employeeId)
            ->where('date', $today)
            ->where('status', 'morning')
            ->first();

        if ($existingAttendance) {
            // If accessed from home page, redirect back to home page
            if (!$request->has('employee_id') || empty($request->employee_id)) {
                return redirect('/')
                    ->with('error', 'Employee already checked in for morning today.');
            }

            return redirect()->back()
                ->with('error', 'Employee already checked in for morning today.');
        }

        TimeAttendance::create([
            'employee_id' => $employeeId,
            'date' => $today,
            'time_in' => $currentTime,
            'status' => 'morning',
        ]);

        // If accessed from home page, redirect back to home page
        if (!$request->has('employee_id') || empty($request->employee_id)) {
            return redirect('/')
                ->with('success', 'Morning check-in recorded successfully.');
        }

        return redirect()->route('time_attendances.index')
            ->with('success', 'Morning check-in recorded successfully.');
    }

    /**
     * Show the form for afternoon check-in.
     */
    public function afternoonCheckIn()
    {
        $employees = Employee::where('status', 'active')->get();
        return view('time_attendances.afternoon_check_in', compact('employees'));
    }

    /**
     * Store a newly created afternoon check-in record.
     */
    public function storeAfternoonCheckIn(Request $request)
    {
        // If no employee_id is provided (direct access from home), use the first active employee
        if (!$request->has('employee_id') || empty($request->employee_id)) {
            $employee = Employee::where('status', 'active')->first();

            if (!$employee) {
                return redirect('/')
                    ->with('error', 'No active employee found. Please create an employee first.');
            }

            $employeeId = $employee->id;
        } else {
            $request->validate([
                'employee_id' => 'required|exists:employees,id',
            ]);

            $employeeId = $request->employee_id;
        }

        $today = Carbon::today()->toDateString();
        $currentTime = Carbon::now()->toTimeString();

        // Check if employee already has afternoon check-in today
        $existingAttendance = TimeAttendance::where('employee_id', $employeeId)
            ->where('date', $today)
            ->where('status', 'afternoon')
            ->first();

        if ($existingAttendance) {
            // If accessed from home page, redirect back to home page
            if (!$request->has('employee_id') || empty($request->employee_id)) {
                return redirect('/')
                    ->with('error', 'Employee already checked in for afternoon today.');
            }

            return redirect()->back()
                ->with('error', 'Employee already checked in for afternoon today.');
        }

        TimeAttendance::create([
            'employee_id' => $employeeId,
            'date' => $today,
            'time_in' => $currentTime,
            'status' => 'afternoon',
        ]);

        // If accessed from home page, redirect back to home page
        if (!$request->has('employee_id') || empty($request->employee_id)) {
            return redirect('/')
                ->with('success', 'Afternoon check-in recorded successfully.');
        }

        return redirect()->route('time_attendances.index')
            ->with('success', 'Afternoon check-in recorded successfully.');
    }

    /**
     * Direct clock in from home page.
     */
    public function directClockIn(Request $request)
    {
        // For simplicity, we'll use the first active employee
        // In a real application, you might want to get the logged-in user
        $employee = Employee::where('status', 'active')->first();

        if (!$employee) {
            return redirect('/')
                ->with('error', 'No active employee found. Please create an employee first.');
        }

        $today = Carbon::today()->toDateString();
        $currentTime = Carbon::now()->toTimeString();

        // Check if employee already clocked in today
        $existingAttendance = TimeAttendance::where('employee_id', $employee->id)
            ->where('date', $today)
            ->first();

        if ($existingAttendance) {
            return redirect('/')
                ->with('error', 'Employee already clocked in today.');
        }

        TimeAttendance::create([
            'employee_id' => $employee->id,
            'date' => $today,
            'time_in' => $currentTime,
            'status' => 'present',
        ]);

        return redirect()->route('/')
            ->with('success', 'Clock in recorded successfully for ' . $employee->name . '.');
    }

    /**
     * Direct clock out from home page.
     */
    public function directClockOut(Request $request)
    {
        // For simplicity, we'll use the first active employee
        // In a real application, you might want to get the logged-in user
        $employee = Employee::where('status', 'active')->first();

        if (!$employee) {
            return redirect('/')
                ->with('error', 'No active employee found. Please create an employee first.');
        }

        $today = Carbon::today()->toDateString();
        $currentTime = Carbon::now()->toTimeString();

        // Check if employee has clocked in but not out today
        $attendance = TimeAttendance::where('employee_id', $employee->id)
            ->where('date', $today)
            ->whereNull('time_out')
            ->first();

        if (!$attendance) {
            return redirect()->route('/')
                ->with('error', 'Employee has not clocked in today or already clocked out.');
        }

        $attendance->update([
            'time_out' => $currentTime,
        ]);

        return redirect()->route('/')
            ->with('success', 'Clock out recorded successfully for ' . $employee->name . '.');
    }

    /**
     * Export time attendance data to Excel using Fast Excel.
     */
    public function exportToExcel(Request $request)
    {
        $request->validate([
            'start_date' => 'required|date',
            'end_date' => 'required|date|after_or_equal:start_date',
        ]);

        $startDate = Carbon::parse($request->start_date)->toDateString();
        $endDate = Carbon::parse($request->end_date)->toDateString();

        $attendances = TimeAttendance::with('employee')
            ->whereBetween('date', [$startDate, $endDate])
            ->orderBy('date' )
            ->orderBy('time_in' )
            ->orderBy('employee_id')
            ->get();

        // Transform the collection for export
        $exportData = $attendances->map(function ($attendance) {
            $statusText = $attendance->status;
            if ($attendance->status == 'morning') {
                $statusText = 'เข้าเช้า';
            } elseif ($attendance->status == 'afternoon') {
                $statusText = 'เข้าบ่าย';
            }

            return [
                'รหัสพนักงาน' => $attendance->employee->id,
                'ชื่อพนักงาน' => $attendance->employee->name,
                'ตำแหน่ง' => $attendance->employee->position,
                'วันที่' => $attendance->date,
                'เวลา' => $attendance->time_in ?? '-',
                'ประเภท' => $statusText,
                'สถานะ' => 'ลงเวลาแล้ว',
            ];
        });

        $filename = 'time_attendance_' . $startDate . '_to_' . $endDate . '.xlsx';

        return (new FastExcel($exportData))->download($filename);
    }
}
