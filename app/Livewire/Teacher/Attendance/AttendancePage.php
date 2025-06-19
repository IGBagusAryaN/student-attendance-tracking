<?php

namespace App\Livewire\Teacher\Attendance;

use App\Exports\AttendanceExport;
use App\Models\Attendance;
use App\Models\Grade;
use App\Models\Student;
use Carbon\Carbon;
use Livewire\Component;
use Maatwebsite\Excel\Facades\Excel;
use Masmerise\Toaster\Toaster;

class AttendancePage extends Component
{
    public $year, $month, $grade;
    public $students = [];
    public $attendance = [];
    public $grades = [];
    public $selectedDay = null;
    public $daysLabel = [];

    public function mount()
    {
        $now = now();

        $this->year = $now->year;           
        $this->month = $now->month;                  
        $this->grade = Grade::first()?->id;
        $this->selectedDay = $now->day;

        $this->grades = Grade::all();
          $this->generateDaysLabel();
    }

    public function generateDaysLabel()
{
    $this->daysLabel = [];

    foreach (range(1, Carbon::create($this->year, $this->month)->daysInMonth) as $day) {
        $date = Carbon::create($this->year, $this->month, $day);
        $dayName = $date->format('l'); // ambil nama hari

        $this->daysLabel[$day] = "Day $day ($dayName)";
    }
}


    public function fetchStudents()
    {
        if ($this->year && $this->month && $this->grade) {
            $this->students = Student::where('grade_id', $this->grade)->get();
        }

        foreach ($this->students as $student) {
            foreach (range(1, Carbon::create($this->year, $this->month)->daysInMonth) as $day) {
                $date = Carbon::create($this->year, $this->month, $day)->format('Y-m-d');

                $this->attendance[$student->id][$day] = Attendance::where('student_id', $student->id)
                    ->whereDate('date', $date)
                    ->value('status') ?? 'check';
            }
        }
    }


    public function updateAttendance($studentId, $selectedDay, $status)
    {
        $date = Carbon::create($this->year, $this->month, $selectedDay)->format('Y-m-d');
        Attendance::updateOrCreate(
            ['student_id' => $studentId, 'date' => $date],
            [
                'status' => $status,
                'grade_id' => $this->grade
            ]
        );

        $this->attendance[$studentId][$selectedDay] = $status;

        Toaster::success('Attendance for date:' . $date . ' for students attendance number ' . $studentId . ' was updated succesfully');
    }

    public function markAll($day, $status)
    {
        foreach ($this->students as $student) {
            $this->updateAttendance($student->id, $day, $status);
        }
    }

    public function exportToExcel()
    {
        return Excel::download(new AttendanceExport($this->year, $this->month, $this->grade), 'attendance.xlsx');
    }


    public function render()
    {
        $this->fetchStudents();
        return view('livewire.teacher.attendance.attendance-page', data: [
            'daysInMonth' => Carbon::create($this->year, $this->month)->daysInMonth,
              'daysLabel'   => $this->daysLabel
        ]);
    }
}
