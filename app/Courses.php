<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    protected $primaryKey = 'Cid';
    public $incrementing = false;

    public function FetchAll(){
        $courses=Courses::paginate(2);
        return $courses;
    }
    public function search($search){

        $course = Courses::where('courses.name', 'LIKE', '%' . $search . '%')
        ->paginate(2);
        return $course;
    }
}
