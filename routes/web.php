<?php

use App\Livewire\Admin\AdminDashboard;
use App\Livewire\Settings\Appearance;
use App\Livewire\Settings\Password;
use App\Livewire\Settings\Profile;
use App\Livewire\Teacher\Attendance\AttendancePage;
use App\Livewire\Teacher\Grades\AddGrade;
use App\Livewire\Teacher\Grades\EditGrade;
use App\Livewire\Teacher\Grades\GradeList;
use App\Livewire\Teacher\Students\AddStudent;
use App\Livewire\Teacher\Students\EditStudent;
use App\Livewire\Teacher\Students\StudentList;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Route;


Route::view('dashboard', 'dashboard')
    ->middleware(['auth', 'verified'])
    ->name('teacher.dashboard');

Route::middleware(['auth'])->group(function () {
    Route::redirect('settings', 'settings/profile');

    Route::get('settings/profile', Profile::class)->name('settings.profile');
    Route::get('settings/password', Password::class)->name('settings.password');
    Route::get('settings/appearance', Appearance::class)->name('settings.appearance');

    #Attendance
    Route::get('/attendance', AttendancePage::class)->name('attendance.page');
});

Route::middleware(['admin', 'auth'])->group(function () {
    Route::get('/admin/dashboard', AdminDashboard::class)->name('admin.dashboard');
    
    #Student
    Route::get('/student-list', StudentList::class)->name('student.index');
    Route::get('/create/student', AddStudent::class)->name('student.create');
    Route::get('/edit/student/{id}', EditStudent::class)->name('student.edit');
  
    #Grade
    Route::get('/grade-list', GradeList::class)->name('grade.index');
    Route::get('/create/grade', AddGrade::class)->name('grade.create');
    Route::get('/edit/grade/{id}', EditGrade::class)->name('grade.edit');
});

Route::get('/lottie/animation-auth.json', function () {
    $path = public_path('lottie/animation-auth.json');

    if (!file_exists($path)) {
        abort(404);
    }

    return Response::file($path, [
        'Content-Type' => 'application/json'
    ]);
});

require __DIR__ . '/auth.php';
