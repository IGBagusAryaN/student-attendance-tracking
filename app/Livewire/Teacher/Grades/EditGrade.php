<?php

namespace App\Livewire\Teacher\Grades;

use App\Models\Grade;
use Livewire\Component;
use Masmerise\Toaster\Toaster;

class EditGrade extends Component
{
    public $name = '';
    public $grade_details;

    public function mount($id)
    {
        $this->grade_details = Grade::find($id);

        $this->fill([
            'name' => $this->grade_details->name,
   
        ]);

    }


    public function update()
    {
        $this->validate([
            'name' => 'required|string',
        ]);

        Grade::find($this->grade_details->id)->update([
            'name' => $this->name,
        ]);

        $this->reset();
        Toaster::success('Grade updated succesfully!');

        return redirect()->route('grade.index');
    }
    public function render()
    {
        return view('livewire.teacher.grades.edit-grade');
    }
}
