<?php

namespace App\Exports;

use App\Models\StudentMarks;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class ResultExport implements FromQuery, WithHeadings, WithMapping
{
    use Exportable;

    public function headings(): array
    {
        return [
            ['ID', 'Student Name','Maths','English','Science', 'Gujarati'],
        ];
    }

    public function __construct($id = 0)
    {
        $this->id = $id;
    }

    public function map($result): array
    {
        return [
            $result->_id,
            $result->Student ? $result->Student->name : null,
            $result->gujarati ? $result->gujarati : "0",
            $result->english ? $result->english : "0",
            $result->maths ? $result->maths : "0",
            $result->science ? $result->science : "0",
        ];
    }

    public function prepareRows($rows)
    {
        return $rows->transform(function ($mark) {
            $mark->_id = $mark->_id;
            $mark->name = $mark->Student? $mark->Student->name : null;
            $mark->gujarati = $mark->gujarati;
            $mark->english = $mark->english;
            $mark->maths = $mark->maths;
            $mark->science = $mark->science;

            return $mark;
        });
    }

    public function query()
    {
        $StudentMarks = StudentMarks::query();
        if($this->id) {
            $StudentMarks->where('_id', $this->id)  ;
        }
        return $StudentMarks->with('Student');
    }

}
