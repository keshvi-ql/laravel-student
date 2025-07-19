<?php

namespace App\Livewire\Teacher\Students;

use App\Models\Student;
use Livewire\Component;
use Masmerise\Toaster\Toaster;
use Livewire\WithPagination;

class StudentList extends Component
{
    use WithPagination;
    public function delete($id){
        Student::find($id)->delete();
        Toaster::success('student deleted successfully!');
        return redirect()->route('student.index');
    }
    public function render()
    {
        $students = Student::paginate(3); // Show 3 students per page
        return view('livewire.teacher.students.student-list', [
            'students' => $students,
        ]);
    }
}
