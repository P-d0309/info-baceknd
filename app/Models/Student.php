<?php

namespace App\Models;

use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;
    protected $collection = 'students';

    protected $fillable = [
        'name',
    ];

    public function StudentMarks()
    {
        return $this->hasMany(StudentMarks::class);
    }
}
