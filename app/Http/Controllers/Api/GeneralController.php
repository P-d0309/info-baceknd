<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResource;
use App\Http\Resources\SubjectsResource;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;

class GeneralController extends Controller
{
    public function getStudents(Request $request) {
        $students = Student::get();

        return new StudentResource($students);
    }

    public function storeStudent(Request $request)
    {

    }

    public function updateStudent(Request $request)
    {
    }

    public function deleteStudent(Request $request)
    {
    }

    public function permanentlyDeleteStudent(Request $request)
    {

    }

    public function getSubjects(Request $request)
    {
        $subjects = Subject::get();
        return new SubjectsResource($subjects);
    }

    public function setMarks() {

    }
}
