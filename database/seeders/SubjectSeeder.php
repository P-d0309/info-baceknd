<?php

namespace Database\Seeders;

use App\Models\Subject;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SubjectSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $subjects = [
            ['name' => 'Maths'],
            ['name' => 'Science'],
            ['name' => 'Gujarati'],
            ['name' => 'English'],
        ];

        Subject::insert($subjects);
    }
}
