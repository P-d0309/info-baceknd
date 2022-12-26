<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;

class StudentMarks extends Model
{
    use HasFactory;

    public $fillable = [
        'studentID',
        'gujarati',
        'english',
        'maths',
        'science',
    ];

    public function Student() {
        return $this->belongsTo(Student::class);
    }
}
