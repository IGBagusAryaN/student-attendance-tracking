<?php

namespace App\Livewire\Teacher\Grades;

use App\Models\Grade;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class GradeList extends Component
{
    public function delete($id)
    {
        Grade::find($id)->delete();
        Toaster::success('Grade delete successfully!');

        return redirect()->route('grade.index');
    }
    public function render()
    {
        return view('livewire.teacher.grades.grade-list', data: ['grades' => Grade::all()]);
    }
}
