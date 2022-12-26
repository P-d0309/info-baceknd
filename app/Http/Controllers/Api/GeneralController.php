<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\MarksRequest;
use App\Http\Requests\StudentRequest;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use App\Models\StudentMarks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;

class GeneralController extends Controller
{
    public function getStudents() {
        $students = Student::get();

        return new StudentResource($students);
    }

    public function storeStudent(StudentRequest $request)
    {
        $student = new Student;
        $student->name = $request->name;
        $student->save();

        return Response::json(['data' => $student]);
    }

    public function updateStudent(StudentRequest $request, $id)
    {
        $student = Student::findOrFail($id);
        $student->name = $request->name;
        $student->save();

        return Response::json(['data' => $student]);
    }

    public function deleteStudent($id)
    {
        Student::where('_id', $id)->delete();
        return $this->getStudents();
    }

    public function permanentlyDeleteStudent($id)
    {
        Student::where('_id', $id)->forceDelete();
        return $this->getStudents();
    }

    public function setMarks(MarksRequest $request) {
        $studentMarks = new StudentMarks;
        $studentMarks->studentID = $request->studentID;
        $studentMarks->english = $request->english;
        $studentMarks->maths = $request->maths;
        $studentMarks->science = $request->science;
        $studentMarks->gujarati = $request->gujarati;
        $studentMarks->save();

        return Response::json(['data' => $studentMarks]);
    }
}
