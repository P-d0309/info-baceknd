<?php

namespace App\Http\Controllers\Api;

use App\Exports\ResultExport;
use App\Http\Controllers\Controller;
use App\Http\Requests\MarksRequest;
use App\Http\Requests\StudentRequest;
use App\Http\Resources\StudentResource;
use App\Models\Student;
use App\Models\StudentMarks;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Response;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

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

    public function getResult() {
        $studentMarks = StudentMarks::with('Student')->get();
        return new StudentResource($studentMarks);
    }

    public function getMarksPdf($id) {
        $fileName = $id.".pdf";

        Excel::store(new ResultExport($id), $fileName, 'public');
        $data = Storage::disk('public')->url($fileName);
        return Response::json(['data' => $data]);
    }

    public function getExcel() {
        Excel::store(new ResultExport, 'result.xlsx', 'public');
        $data = Storage::disk('public')->url('result.xlsx');
        return Response::json(['data' => $data]);
    }
}
