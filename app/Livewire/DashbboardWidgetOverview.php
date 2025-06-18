<?php

namespace App\Livewire;

use App\Models\Attendance;
use App\Models\Student;
use App\Models\User;
use Carbon\Carbon;
use Livewire\Component;

class DashbboardWidgetOverview extends Component
{
    public $totalStudents;
    public $totalTeachers;
    public $totalUsers;
    public $presentToday;
    public $absentToday;
    public $weeklyAttendanceRate;
    public $monthlyTrends = [];
    public $attendanceToday;


    public function mount()
    {
        $today = Carbon::today();
        $weekStart = Carbon::now()->startOfWeek();
        $weekEnd = Carbon::now()->endOfWeek();
        $monthStart = Carbon::now()->startOfMonth();
        $monthEnd = Carbon::now()->endOfWeek();

        $this->totalStudents = Student::count();
        $this->totalUsers = User::count();
        $this->totalTeachers = User::where('role', 'teacher')->count();
        $this->attendanceToday = Attendance::whereDate('date', $today)->where('status', 'present')->count();
        $this->presentToday = Attendance::whereDate('date', $today)->where('status', 'present')->count();
        $this->absentToday = Attendance::whereDate('date', $today)->where('status', 'absent')->count();

        $totalClasses = Attendance::whereBetween('date', [$weekStart, $weekEnd])->count();
        $presentCount = Attendance::whereBetween('date', [$weekStart, $weekEnd])->where('status', 'present')->count();
        $this->weeklyAttendanceRate = $totalClasses > 0 ? round(($presentCount / $totalClasses) * 100, 2) : 0 ;

        for ($i =1; $i <= Carbon::now()->daysInMonth(); $i++) {
            $date = Carbon::createFromDate(Carbon::now()->year, Carbon::now()->month, $i);
            $this->monthlyTrends[] = [
                'day' => $i,
                'count' => Attendance::whereDate('date', $date)->where('status', 'present')->count(),
            ];
        }
    }

    public function render()
    {
        return view('livewire.dashbboard-widget-overview');
    }
}
