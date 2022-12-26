<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StudentResource;
use App\Http\Resources\SubjectsResource;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class GeneralController extends Controller
{
    public function getStudents() {
        $students = Student::get();

        return new StudentResource($students);
    }

    public function storeStudent(Request $request)
    {
        $student = new Student;
        $student->name = $request->name;
        $student->save();

        return Response::json(['data' => $student]);
    }

    public function updateStudent(Request $request, $id)
    {
        $student = Student::findOrFail($id);
        $student->name = $request->name;
        $student->save();

        return Response::json(['data' => $student]);
    }

    public function deleteStudent(Request $request, $id)
    {
        Student::where('_id', $id)->delete();
        return $this->getStudents();
    }

    public function permanentlyDeleteStudent(Request $request, $id)
    {
        Student::where('_id', $id)->forceDelete();
        return $this->getStudents();
    }

    public function getSubjects(Request $request)
    {
        $subjects = Subject::get();
        return new SubjectsResource($subjects);
    }

    public function setMarks() {

    }
}
