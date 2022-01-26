<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Courses extends Model
{
    protected $primaryKey = 'Cid';
    public $incrementing = false;

    public function fetch_all(){
        $courses=self::paginate(2);
        return $courses;
    }

    public function store($input){
        $course=new self();
        $course->Cid=$input['Cid'];
        $course->CourseName=$input['CourseName'];
        $course->save();
        return $course;
        
    }

    public function find($id){
        $courses=self::find($id);  
        return $courses;
    }

    public function update_course( $input,$Cid){

        $course = Courses::find($Cid);  
        $course->CourseName =$input['CourseName'];  
        $course->save();  

    }

    Public function delete_course($Cid){

        $course=self::find($Cid);  
        $course->delete();  
    }

    public function get_name_id(){
        $courses = self::pluck("CourseName","Cid");
        return $courses;
    }
    
    public function search($search){

        $course = self::where('courses.name', 'LIKE', '%' . $search . '%')
        ->paginate(2);
        return $course;
    }
}
