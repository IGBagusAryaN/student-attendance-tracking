<?php

namespace App\Livewire\Teacher\Students;

use App\Models\Student;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class StudentList extends Component
{
    public function delete($id)
    {
        Student::find($id)->delete();
        Toaster::success('Student delete successfully!');

        return redirect()->route('student.index');
    }

    public function render()
    {
        return view('livewire.teacher.students.student-list', data:['students' => Student::all()]);
    }
}
