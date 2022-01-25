<?php

namespace App;
use App\User;

use Illuminate\Database\Eloquent\Model;

class Teachers extends Model
{
    protected $primaryKey = 'Tid';
    public $incrementing = false;

    public function fetch_all(){
        $teachers=Teachers::leftJoin('users', 'users.id', '=', 'teachers.Tid')
        ->paginate(3);
        return $teachers;
    }

    public function find($id){
        $teacher=Teachers::find($id); 
        return $teacher;
    }

    public function store($request){

        $teacher=new Teachers();
        $teacher->Tid=$request->input('Tid');
        $teacher->number=$request->input('number');
        $teacher->designation=$request->input('designation');
        $teacher->courseid=$request->input('courseid');
        $teacher->speciality=$request->input('speciality');
        $teacher->save();
        return $teacher;
    }

    public function update($request,$Tid){

        $teacher = Teachers::find($Tid);  
        $teacher->number =$request->get('number');  
        $teacher->designation =$request->get('designation');  
        $teacher->speciality =$request->get('speciality');  
        $teacher->save();  
        return $teacher;

    }

    public function delete($Tid){
        $teacher=Teachers::find($Tid);  
        $teacher->delete();  
    }

    public function search($search){

        $teacher = Teachers::leftJoin('users','users.id', '=' , 'teachers.Tid')
        ->where('users.name', 'LIKE', '%' . $search . '%')
        ->paginate(2);
        return $teacher;
    }
}
