<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Jenssegers\Mongodb\Eloquent\Model;
use Jenssegers\Mongodb\Eloquent\SoftDeletes;

class Student extends Model
{
    use SoftDeletes;
    protected $collection = 'students';

    protected $fillable = [
        'name',
    ];
}
