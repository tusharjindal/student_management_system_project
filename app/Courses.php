<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    protected $primaryKey = 'Cid';
    public $incrementing = false;

    public function fetch_all(){
        $courses=Courses::paginate(2);
        return $courses;
    }

    public function store($request){
        $course=new Courses();
        $course->Cid=$request->input('Cid');
        $course->CourseName=$request->input('CourseName');
        $course->save();
        return $course;
        
    }
    public function get_name_id(){
        $courses = Courses::pluck("CourseName","Cid");
        return $courses;
    }
    public function search($search){

        $course = Courses::where('courses.name', 'LIKE', '%' . $search . '%')
        ->paginate(2);
        return $course;
    }
}
